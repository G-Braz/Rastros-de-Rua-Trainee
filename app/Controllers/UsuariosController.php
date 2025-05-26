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
}