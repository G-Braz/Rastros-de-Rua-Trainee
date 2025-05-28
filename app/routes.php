<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');
$router->get('usuarios', 'UsuariosController@index');
$router->post('usuarios/criar_usuario', 'UsuariosController@criar_usuario');
$router->post('usuarios/editar_usuario', 'UsuariosController@editar_usuario');