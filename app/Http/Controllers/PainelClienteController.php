<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PainelClienteController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth:logclientes');
    }
    
    public function index(){
        return view('clientes.index');
    }
}
