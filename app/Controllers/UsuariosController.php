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

    // -------------------------------------------------------------------------
    // Função para verificar a existência de dois e-mails
    // -------------------------------------------------------------------------

    private function verificarEmailExistente($email, $id_usuario = null) {
        $conditions = ['email' => $email];
        $existing_user = App::get('database')->selectOne('usuarios', $conditions, $id_usuario);
        
        if($existing_user) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false]);
            exit;
        }
    }

    // -------------------------------------------------------------------------
    // Cria um novo usuário
    // -------------------------------------------------------------------------

    public function criar_usuario() {
        $this->verificarEmailExistente($_POST['email']);
        
        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        ];
        
        App::get('database')->insert('usuarios', $parameters);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'redirect' => '/usuarios'
        ]);
        exit;
    }
    // ------------------------------------------------------------------------
    // Atualiza um usuário existente
    // ------------------------------------------------------------------------
    public function editar_usuario() {
        $id_usuario = $_POST['id'];
        $this->verificarEmailExistente($_POST['email'], $id_usuario);

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];
        
        if(!empty($_POST['senha'])) {
            $parameters['senha'] = $_POST['senha'];
        }
        
        App::get('database')->update('usuarios', $parameters, $id_usuario);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'redirect' => '/usuarios'
        ]);
        exit;
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