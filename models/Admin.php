<?php

namespace Model;

use Model\ActiveRecord;

class Admin extends ActiveRecord{
    // Base de datos
    protected static $table = 'usuarios';
    protected static $columnasDB = ['id','email','password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if (!$this->email) {
            self::$errores[] = 'El email es obligatorio o el email ingresado no es válido';
        }
        if (!$this->password) {
            self::$errores[] = 'El password es obligatorio o el password ingresado no es válido';
        }
        return self::$errores;
    }

    public function existeUser() {
        // revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

        $result = self::$db->query($query);

        if(!$result->num_rows) {
            self::$errores[] = 'El Usuario no existe';
            return;
        }
        return $result;
        
    }

    public function comprobarPassword($result) {
        $user = $result->fetch_object();
        
        $autenticado = password_verify($this->password, $user->password);

        if(!$autenticado) {
            self::$errores[] = 'El password es incorrecto';
        }
        return $autenticado;
    }

    public function autenticar() {
        session_start();

        // llenar el arreglo de la sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}