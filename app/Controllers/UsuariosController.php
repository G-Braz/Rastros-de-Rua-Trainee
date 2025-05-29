<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {
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

    public function criar_usuario()
    {
        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        ];
        App::get('database')->insert('usuarios', $parameters);

        header('Location: /usuarios');
    }
    public function editar_usuario(){
        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        ];
        $id = $_POST['id'];

        App::get('database')->update('usuarios', $id, $parameters);
        header('Location: /usuarios');
    }

    public function excluir_usuario()
    {
        $id = $_POST['id'];
        
        App::get('database')->delete('usuarios', $id);
        header('Location: /usuarios');
    }
}