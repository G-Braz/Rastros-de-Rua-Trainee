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
}