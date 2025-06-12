<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PagInicialController
{
    public function exibirPaginaInicial()
    {
        $posts = App::get('database')->selectAll('publicacoes', 0, 5);
        return view('site/paginaInicial', ['posts' => $posts]);
    }
}