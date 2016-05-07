<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UsuariosController extends Controller
{
    private $usuarios;
    
    public function __construct(User $usuarios)
    {
        $this->usuarios = $usuarios;

    }
    
    //*********************************************************************
    //Exibe a listagem inicial
    public function getIndex()
    {
        $usuarios = $this->usuarios->all();
        return view('painel.listagens.usuarios', compact('usuarios'));
    }
    //********************************************************************
}
