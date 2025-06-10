<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class ListaPostsController
{
        public function exibirLista()
        {
                $page = 1;
                if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
                        $page = intval($_GET['paginacaoNumero']);
                }
                if($page<=0){
                        return redirect('site/listaPosts');
                }
                $itens_page = 6;
                $inicio = $itens_page * $page - $itens_page;
                $num_posts = App::get('database')->countAll('publicacoes');

                if($inicio > $num_posts){
                        return redirect('site/listaPosts');
                }
                $posts = App::get('database')->selectAll('publicacoes', $inicio, $itens_page);
                $total_pages = ceil($num_posts / $itens_page);
                return view('site/listaPosts', [
                        'posts' => $posts,
                        'page' => $page,
                        'total_pages' => $total_pages
                ],);
        }
        public function exibirPost($id)
        {
            $post = App::get('database')->findById('publicacoes', $id);
        
            return view('site/postIndividual', ['post' => $post]);
        }
        public function buscaPorTitulo()
        {
            $termo = $_GET['termo'] ?? '';
            $page = isset($_GET['paginacaoNumero']) ? intval($_GET['paginacaoNumero']) : 1;
            $itens_page = 6;
            $inicio = $itens_page * $page - $itens_page;

            $todosPosts = App::get('database')->buscaPorTitulo($termo);
            $num_posts = count($todosPosts);

            $posts = array_slice($todosPosts, $inicio, $itens_page);
            
            $html = '';
            foreach ($posts as $post) {
                $html .= '<li>
                    <a href="/listaPosts/' . $post->id . '" class="post">
                        <img src="/' . $post->img_arte . '" class="fotoCapa">
                        <img src="/' . $post->img_tag . '" class="fotoTag">
                        <div class="textoPost">
                            <h1>' . htmlspecialchars($post->titulo) . '</h1>
                            <p>' . htmlspecialchars($post->descricao) . '</p>
                        </div>
                    </a>
                </li>';
            }

            $total_pages = ceil($num_posts / $itens_page);

            echo json_encode([
                'html' => $html,
                'total_pages' => $total_pages,
                'page' => $page
            ]);
            exit;
        }
        
       public function buscaPorTipo()
        {
            $tipo = $_GET['tipo'] ?? '';
            $page = isset($_GET['paginacaoNumero']) ? intval($_GET['paginacaoNumero']) : 1;
            $itens_page = 6;
            $inicio = $itens_page * $page - $itens_page;
            if($tipo == ''){
                    $todosPosts = App::get('database')->selectAll('publicacoes', 0, 10000); // pega todos
            }
            else {
                $todosPosts = App::get('database')->buscaPorTipo($tipo);
            }

            $num_posts = count($todosPosts);


            $posts = array_slice($todosPosts, $inicio, $itens_page);
            $html = '';
            foreach ($posts as $post) {
                $html .= '<li>
                    <a href="/listaPosts/' . $post->id . '" class="post">
                        <img src="/' . $post->img_arte . '" class="fotoCapa">
                        <img src="/' . $post->img_tag . '" class="fotoTag">
                        <div class="textoPost">
                            <h1>' . htmlspecialchars($post->titulo) . '</h1>
                            <p>' . htmlspecialchars($post->descricao) . '</p>
                        </div>
                    </a>
                </li>';
            }

            $total_pages = ceil($num_posts / $itens_page);

            echo json_encode([
                'html' => $html,
                'total_pages' => $total_pages,
                'page' => $page
            ]);
            exit;
        }
}