<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {

        // Arreglo de errores
        $errores = [];

        // Autenticar al usuario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);

            $errores = $auth->validar();


            if (empty($errores)) {
                // Revisar si el usuario existe
                $result = $auth->existeUser();

                if(!$result) {
                    // Si el usuario no existe se muestra el error
                    $errores = Admin::getErrores();
                }else {
                    // Verificar el password
                    $autenticado = $auth->comprobarPassword($result);

                    if($autenticado) {
                        // Autenticar al usuario
                        $auth->autenticar();
                    }else {
                        // obtiene el mensaje de error cuando el password es incorecto
                        $errores = Admin::getErrores();
                    }

                }





            }
        }

        $router->render('/auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];

        header('Location: /');
    }
}
