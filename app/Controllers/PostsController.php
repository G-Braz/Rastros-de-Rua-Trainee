<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{

    public function index()
    {
        $posts = APP::get('database')->selectAll('publicacoes');
        return view('admin/pagina-de-posts', compact('posts'));
    }
}