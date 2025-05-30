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
        //Imagem
        $tempArte= $_FILES['img_arte']['tmp_name'];
        $nomeImagem= sha1(uniqid($_FILES['img_arte']['name'], true)) . "." . pathinfo($_FILES['img_arte']['name'],PATHINFO_EXTENSION) ;

        $caminhoImg= "public/assets/imagensPosts/" . $nomeImagem; 

        move_uploaded_file($tempArte, $caminhoImg);

        //TAG
        $tempTag= $_FILES['img_tag']['tmp_name'];
        $nomeTag= sha1(uniqid($_FILES['img_tag']['name'], true)) . "." . pathinfo($_FILES['img_tag']['name'],PATHINFO_EXTENSION) ;

        $caminhoTag= "public/assets/imagensPosts/" . $nomeTag; 

        move_uploaded_file($tempTag, $caminhoTag);    

        $parameters = [
            'titulo'     => $_POST['titulo'],
            'autor'      => $_POST['autor'],
            'descricao'  => $_POST['descricao'],
            'materiais'  => $_POST['materiais'],
            'latitude'   => $_POST['latitude'],
            'longitude'  => $_POST['longitude'],
            'local'      => 'juiz de fora',
            'usuarios_id'   => 6,
            'img_arte'    => $caminhoImg,
            'img_tag'     => $caminhoTag,
        ];

        App::get('database')->insert('publicacoes', $parameters);

        header('Location: /posts');
    }
    public function edit()
    {
        //Imagem
        $tempArte= $_FILES['img_arte']['tmp_name'];
        $nomeImagem= sha1(uniqid($_FILES['img_arte']['name'], true)) . "." . pathinfo($_FILES['img_arte']['name'],PATHINFO_EXTENSION) ;

        $caminhoImg= "public/assets/imagensPosts/" . $nomeImagem; 

        move_uploaded_file($tempArte, $caminhoImg);

        //TAG
        $tempTag= $_FILES['img_tag']['tmp_name'];
        $nomeTag= sha1(uniqid($_FILES['img_tag']['name'], true)) . "." . pathinfo($_FILES['img_tag']['name'],PATHINFO_EXTENSION) ;

        $caminhoTag= "public/assets/imagensPosts/" . $nomeTag; 

        move_uploaded_file($tempTag, $caminhoTag);    

            $parameters = [
            'titulo'     => $_POST['titulo'],
            'autor'      => $_POST['autor'],
            'descricao'  => $_POST['descricao'],
            'materiais'  => $_POST['materiais'],
            'latitude'   => $_POST['latitude'],
            'longitude'  => $_POST['longitude'],
            'local'      => 'juiz de fora',
            'usuarios_id'   => 6,
            'img_arte'    => $caminhoImg,
            'img_tag'     => $caminhoTag,
            ];
        $id= $_POST['id'];

        App::get('database')->update('publicacoes', $parameters, $id);

        header('Location: /posts');
    }

    public function delete(){
        $id = $_POST['id'];

        APP::get('database')->delete('publicacoes', $id);

        header('Location: /posts');
    }
}