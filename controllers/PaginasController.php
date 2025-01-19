<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $inicio = true;

        $propiedades = Propiedad::limitAll(3);

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    public static function anuncios(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }
    public static function anuncio(Router $router)
    {
        // Obtener el id del GET
        $id = validarRedireccionar('/');

        // Realizar el query
        $propiedad = Propiedad::find($id);

        $router->render('paginas/anuncio', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER["REQUEST_METHOD"] === "POST") {

            $respuestas = $_POST;
            
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            /** Configurar SMTP */ 
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'bde773263b39da';    
            $mail->Password = '408c9eb8e70591';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            
            /** Configurar el contenido del emial */ 
            // Quien envia 
            $mail->setFrom('admin@bienesraices.com');
            // A que emial le va a llegar
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';



            /** Definir el contenido */
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['opciones'] . '</p>';
            $contenido .= '<p>Presupuesto: $' . $respuestas['presupuesto'] . '</p>';
            $contenido .= '<p>Forma de Contactar: ' . $respuestas['contacto'] . '</p>';

            /** Enviar correo de forma condicional, dependiendo del campo seleccionado */
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha a contactar: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora a contactar: ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            /** Enviar el emial */
            if($mail->send()) {
                $mensaje = true;
            }else {
                $mensaje = false;
            }

        }


        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}

