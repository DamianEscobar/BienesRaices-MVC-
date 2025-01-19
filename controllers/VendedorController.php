<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;


class VendedorController
{

    public static function create(Router $router)
    {

        $vendedor = new Vendedor;

        // Arreglo con los mensajes de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una nueva instancia con los datos enviados por POST
            $vendedor = new Vendedor($_POST);

            // Validar los campos, no deben estar vacios
            $errores = $vendedor->validar();

            // Guardar si no hay errores
            if (empty($errores)) {
                $vendedor->save();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function update(Router $router)
    {

        // Arreglo con los mensajes de errores
        $errores = Vendedor::getErrores();

        // Validar el ID
        $id = validarRedireccionar('/admin');

        // Obtener los datos de la propiedad
        $vendedor = Vendedor::find($id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una nueva instancia con los datos enviados por POST
            $vendedor->sincronizar($_POST);

            // Validar los campos, no deben estar vacios
            $errores = $vendedor->validar();

            // Guardar si no hay errores
            if (empty($errores)) {
                $vendedor->save();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            // Validar el ID
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->delete();
                }
            }
        }
    }
}
