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
    public function create()
    {
        $arteNome = $_FILES['arte']['name'] ?? null;
        $tagNome = $_FILES['tag']['name'] ?? null;

        $parameters = [
            'titulo'     => $_POST['titulo'],
            'autor'      => $_POST['autor'],
            'descricao'  => $_POST['descricao'],
            'materiais'  => $_POST['materiais'],
            'latitude'   => 0,
            'longitude'  => 0,
            'local'      => 'juiz de fora',
            'usuarios_id'   => 6,
            'img_arte'    => $arteNome,
            'img_tag'     => $tagNome
        ];

        App::get('database')->insert('publicacoes', $parameters);

        header('Location: /posts');
    }
    public function edit()
    {
        $arteNome = $_FILES['arte']['name'] ?? null;
        $tagNome = $_FILES['tag']['name'] ?? null;
            $parameters = [
            'titulo'     => $_POST['titulo'],
            'autor'      => $_POST['autor'],
            'descricao'  => $_POST['descricao'],
            'materiais'  => $_POST['materiais'],
            'latitude'   => 0,
            'longitude'  => 0,
            'local'      => 'juiz de fora',
            'data'=> date('d/m/Y'),
            'usuarios_id'   => 6,
            'img_arte'    => $arteNome,
            'img_tag'     => $tagNome
            ];
        $id= 19;

        App::get('database')->update('publicacoes', $parameters, $id);

        header('Location: /posts');
    }

    public function delete(){
        $id = $_POST['id'];

        APP::get('database')->delete('publicacoes', $id);

        header('Location: /posts');
    }
}