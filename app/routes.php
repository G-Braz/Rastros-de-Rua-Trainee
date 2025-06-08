<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('login', 'LoginController@exibirLogin');
$router->get('admin/dashboard', 'LoginController@exibirDashboard');
$router->get('landingPage', 'LoginController@exibirLandingPage');
$router->post('login','LoginController@efetuarLogin');
$router->post('logout','LoginController@logout');
$router->get('posts', 'PostsController@index');
$router->post('posts/create','PostsController@create');
$router->post('posts/edit','PostsController@edit');
$router->post('posts/delete','PostsController@delete');
$router->get('listaPosts', 'ListaPostsController@exibirLista');
$router->get('listaPosts/{id}', 'ListaPostsController@exibirPost');