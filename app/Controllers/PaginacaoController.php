<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginacaoController
{
        public function index(){
                $page = 1;
                if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
                        $page = intval($_GET['paginacaoNumero']);
                }
                if($page<=0){
                        return redirect('admin/Lista-de-Usuarios');
                }
                $itens_page = 5;
                $inicio = $itens_page * $page - $itens_page;
                $rows_count = App::get('database')->countAll('usuarios');

                if($inicio > $rows_count){
                        return redirect('admin/Lista-de-Usuarios');
                }
                $usuarios = App::get('database')->selectAll('usuarios', $inicio, $itens_page);
                $total_pages = ceil($rows_count/$itens_page);
                return view('admin/Lista-de-Usuarios', [
                        'usuarios' => $usuarios,
                        'page' => $page,
                        'total_pages' => $total_pages
                ]);
        }
}