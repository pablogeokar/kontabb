<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;
use App\forma_tributacao;

class ClienteController extends Controller {

    private $clientes;
    private $forma_tributacao;

    public function __construct(Cliente $clientes, forma_tributacao $forma_tributacao ) {
        $this->clientes = $clientes;
        $this->forma_tributacao = $forma_tributacao;
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
        //Busca as formas de tributação
        $formasTributacao = $this->forma_tributacao->get();
        return view('painel.forms.cadClientes', compact('formasTributacao'));
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
                
        //Busca as formas de tributação
        $formasTributacao = $this->forma_tributacao->get(['id', 'nome']);
        //$formasTributacao = $this->forma_tributacao->list('id', 'nome');
        return view('painel.forms.cadClientes', compact('clientes', 'cpf_cnpj', 'formasTributacao'));
    }
    //*********************************************************************
    //Salva os dados alterados
    public function postEditar(Request $request, $cpf_cnpj) {
        $dadosForm = $request->except('_token', 'salvar');

        //Persiste a alteração no banco
        $this->clientes->where('cpf_cnpj', $cpf_cnpj)->update($dadosForm);

        //Redireciona para a rota de listagens
        return redirect('painel/clientes');
    }

}
