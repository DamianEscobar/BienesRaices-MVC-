<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropiedadController
{
    public static function index(Router $router)
    {

        $result = $_GET['result'] ?? null;

        // Implementar un metodo para obtener las propiedades/casas
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        $router->render('/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'result' => $result
        ]);
    }

    public static function create(Router $router)
    {

        $propiedad = new Propiedad;

        // Obtener los vendedores de la base de datos
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        // Ejecuta el codigo una vez el usuario envie el formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $propiedad = new Propiedad($_POST);

            //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Usando intervetion image
            if ($_FILES['imagen']['tmp_name']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();


            if (empty($errores)) {

                /** Subida de imagenes */
                // Revisamos si existe la carpeta y la creamos
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar en la base de datos
                $propiedad->save();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function update(Router $router)
    {

        $id = validarRedireccionar('/admin');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);


        // Obtener los vendedores de la base de datos
        $vendedores = Vendedor::all();


        //Arreglo de errores
        $errores = [];

        // Ejecuta el codigo una vez el usuario envie el formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Pasar el arreglo para sincronizar y convertir en objeto
            $propiedad->sincronizar($_POST);

            /** CARGAR LA IMAGEN */
            //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";


            $errores = $propiedad->validar();

            if (empty($errores)) {

                /** Subida de imagenes */
                // Revisamos si existe la carpeta y la creamos
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Usando intervetion image
                if ($_FILES['imagen']['tmp_name']) {
                    $manager = new Image(Driver::class);
                    $imagen = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
                    $propiedad->setImagen($nombreImagen);

                    // Guaradar la imagen en el server
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                //Insertar en la base de datos
                $propiedad->save();
            }
        }


        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function delete() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            // Validar el ID
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            if($id) {
              $tipo = $_POST['tipo'];
        
              if(validarTipoContenido($tipo)) {
                $propiedad = Propiedad::find($id);
                $propiedad->delete();
        
              }
        
            }
          }
    }
}
