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
}