<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{
    // ------------------------------------------------------------------------
    // Lista todos os usuários com paginação
    // ------------------------------------------------------------------------
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
        $num_linhas = App::get('database')->countAll('usuarios');

        if($inicio > $num_linhas){
                return redirect('admin/Lista-de-Usuarios');
        }
        $usuarios = App::get('database')->selectAll('usuarios', $inicio, $itens_page);
        $total_pages = ceil($num_linhas /$itens_page);
        return view('admin/Lista-de-Usuarios', [
                'usuarios' => $usuarios,
                'page' => $page,
                'total_pages' => $total_pages
        ]);
    }
     // ------------------------------------------------------------------------
    // Cria um novo usuário
    // ------------------------------------------------------------------------
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
    // ------------------------------------------------------------------------
    // Atualiza um usuário existente
    // ------------------------------------------------------------------------
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
     // ------------------------------------------------------------------------
    // Exclui um usuário
    // ------------------------------------------------------------------------
    public function excluir_usuario()
    {
        $id = $_POST['id'];
        
        App::get('database')->delete('usuarios', $id);
        header('Location: /usuarios');
    }
}