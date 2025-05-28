<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {
        $usuarios = App::get('database')->selectAll('usuarios');
        return view('admin/Lista-de-Usuarios', compact('usuarios'));
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
        var_dump($_POST);
        exit;
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