<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;

$router = new Router();

/** ADMINISTRACION */

/** PROPIEDADES */
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'create']);
$router->post('/propiedades/crear', [PropiedadController::class, 'create']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'update']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'update']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'delete']);

/** VENDEDORES */
$router->get('/vendedores/crear', [VendedorController::class, 'create']);
$router->post('/vendedores/crear', [VendedorController::class, 'create']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'update']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'update']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'delete']);


/** VISITANTES */

$router->get('/',[PaginasController::class, 'index']);
$router->get('/nosotros',[PaginasController::class, 'nosotros']);
$router->get('/anuncios',[PaginasController::class, 'anuncios']);
$router->get('/anuncio',[PaginasController::class, 'anuncio']);
$router->get('/blog',[PaginasController::class, 'blog']);
$router->get('/entrada',[PaginasController::class, 'entrada']);
$router->get('/contacto',[PaginasController::class, 'contacto']);
$router->post('/contacto',[PaginasController::class, 'contacto']);


/** Login y Autenticacion */
$router->get('/login',[LoginController::class, 'login']);
$router->post('/login',[LoginController::class, 'login']);
$router->get('/logout',[LoginController::class, 'logout']);

$router->comprobarRutas();