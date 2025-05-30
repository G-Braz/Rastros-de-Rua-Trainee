<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('login', 'LoginController@exibirLogin');
$router->get('admin/dashboard', 'LoginController@exibirDashboard');
$router->post('login','LoginController@efetuarLogin');

?>