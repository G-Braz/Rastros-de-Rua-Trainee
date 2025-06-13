<?php
namespace App\Controllers;

use App\Core\App;
use Exception;

class PostsController
{
    public function index()
    {
        $page = 1;
        if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
                $page = intval($_GET['paginacaoNumero']);
        }
        if($page<=0){
                return redirect('admin/pagina-de-posts');
        }
        $itens_page = 5;
        $inicio = $itens_page * $page - $itens_page;
        $num_linhas = App::get('database')->countAll('publicacoes');

        if($inicio > $num_linhas){
                return redirect('admin/pagina-de-posts');
        }
        $posts = App::get('database')->selectAll('publicacoes', $inicio, $itens_page);
        $total_pages = ceil($num_linhas /$itens_page);
        return view('admin/pagina-de-posts', [
                'posts' => $posts,
                'page' => $page,
                'total_pages' => $total_pages
        ]);
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
            'titulo'        => $_POST['titulo'],
            'autor'         => $_POST['autor'],
            'descricao'     => $_POST['descricao'],
            'materiais'     => $_POST['materiais'],
            'latitude'      => $_POST['latitude'],
            'longitude'     => $_POST['longitude'],
            'local'         => $_POST['local'],
            'usuarios_id'   => $_POST['usuarios_id'],

            'img_arte'      => $caminhoImg,
            'img_tag'       => $caminhoTag,
            'tipo'          => $_POST['tipo'],
        ];

        App::get('database')->insert('publicacoes', $parameters);

        header('Location: /posts');
    }
    public function edit()
    {
        session_start();
        // Imagem Arte
        if (!empty($_FILES['img_arte']['name'])) { // verifica se a imagem foi alterada

            $tempArte = $_FILES['img_arte']['tmp_name'];

            $nomeImagem = sha1(uniqid($_FILES['img_arte']['name'], true)) . "." . pathinfo($_FILES['img_arte']['name'], PATHINFO_EXTENSION);

            $caminhoImg = "public/assets/imagensPosts/" . $nomeImagem;

            move_uploaded_file($tempArte, $caminhoImg);

        } else { // se não foi alterada, mantém a imagem atual

            $caminhoImg = $_POST['img_arte_atual'];
        }
        
        // Imagem Tag
        if (!empty($_FILES['img_tag']['name'])) { // verifica se a tag foi alterada

            $tempTag = $_FILES['img_tag']['tmp_name'];

            $nomeTag = sha1(uniqid($_FILES['img_tag']['name'], true)) . "." . pathinfo($_FILES['img_tag']['name'], PATHINFO_EXTENSION);

            $caminhoTag = "public/assets/imagensPosts/" . $nomeTag;

            move_uploaded_file($tempTag, $caminhoTag);

        } else { // se não foi alterada, mantém a tag atual
            
            $caminhoTag = $_POST['img_tag_atual'];
        }


        $parameters = [
            'titulo'        => $_POST['titulo'],
            'autor'         => $_POST['autor'],
            'descricao'     => $_POST['descricao'],
            'materiais'     => $_POST['materiais'],
            'latitude'      => $_POST['latitude'],
            'longitude'     => $_POST['longitude'],
            'local'         => $_POST['local'],
            'usuarios_id'   => $_SESSION['id'],
            
            'img_arte'      => $caminhoImg,
            'img_tag'       => $caminhoTag,
            'tipo'          => $_POST['tipo'],
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