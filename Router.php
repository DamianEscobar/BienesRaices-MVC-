<?php
namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas() {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if($fn) {
            //La url existe y hay una funcion asociada
            call_user_func($fn, $this);
        }else {
            echo "Pagina no encontrada";
        }

    }

    // Mostrar vista
    public function render($view, $datos = []) {
        
        foreach($datos as $key => $value) {
            // Variable de variable
            $$key = $value;
        }

        // Se activa el buffer de salida para capturar el contenido generado por el archivo views/$view.php
        ob_start();
        include __DIR__ . "/views/$view.php";

        //El contenido del archivo views/$view.php se guarda en la variable $contenido. El buffer se limpia y se desactiva.
        $contenido = ob_get_clean(); // limpiar

        include __DIR__ . "/views/layout.php";

    }

}