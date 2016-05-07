<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;

class ClienteController extends Controller {

    private $clientes;

    public function __construct(Cliente $clientes) {
        $this->clientes = $clientes;
    }

    //*********************************************************************
    //Exibe a listagem inicial 
    public function getIndex() {
        $clientes = $this->clientes->all();
        return view('painel.listagens.clientes', compact('clientes'));
    }

    //*********************************************************************
    //*********************************************************************
    //Exibe o formulário para cadastrar
    public function getCadastrar() {
        return view('painel.forms.cadClientes');
    }

    //*********************************************************************  
    //*********************************************************************
    //post Cadastrar
    public function postCadastrar(Request $request) {
        $dadosForm = $request->except('_token');

        //Cria um novo usuário
        $this->clientes->create($dadosForm);

        //Redireciona para a rota de listagens
        return redirect('painel/clientes');
    }

    //*********************************************************************
    //*********************************************************************
    //Exibe o formulário para edição
    public function getEditar($cpf_cnpj) {
        $clientes = $this->clientes->where('cpf_cnpj', $cpf_cnpj )->first();        
        return view('painel.forms.cadClientes', compact('clientes', 'cpf_cnpj'));
    }

}
