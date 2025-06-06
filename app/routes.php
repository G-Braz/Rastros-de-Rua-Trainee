<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');
$router->get('posts', 'PostsController@index');
$router->post('posts/create','PostsController@create');
$router->post('posts/edit','PostsController@edit');
$router->post('posts/delete','PostsController@delete');
$router->get('listaPosts', 'ListaPostsController@exibirLista');
$router->get('listaPosts/{id}', 'ListaPostsController@exibirPost');