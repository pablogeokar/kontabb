<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;
use App\forma_tributacao;
use Cache;

class ClienteController extends Controller {

    private $clientes;
    private $forma_tributacao;

    public function __construct(Cliente $clientes, forma_tributacao $forma_tributacao) {
        $this->clientes = $clientes;
        $this->forma_tributacao = $forma_tributacao;
    }

    //*********************************************************************
    //Exibe a listagem inicial 
    public function getIndex() {
        /*
          $clientes = Cache::remember('clientes', 60, function() {
          return $this->clientes
          ->join('forma_tributacaos', 'forma_tributacaos.id', '=', 'clientes.id_forma_tributacao')
          ->orderBy('nome_razaosocial')
          ->get();
          });
         * 
         */
        $clientes = $this->clientes
                ->join('forma_tributacaos', 'forma_tributacaos.id', '=', 'clientes.id_forma_tributacao')
                ->orderBy('nome_razaosocial')
                ->get();

        //dd($clientes);

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

        //Verifica se os checkBox estão marcados
        (isset($dadosForm['cl_fl_pagto'])) ? $dadosForm['cl_fl_pagto'] = 1 : $dadosForm['cl_fl_pagto'] = 0;
        (isset($dadosForm['cl_gps'])) ? $dadosForm['cl_gps'] = 1 : $dadosForm['cl_gps'] = 0;
        (isset($dadosForm['cl_fgts'])) ? $dadosForm['cl_fgts'] = 1 : $dadosForm['cl_fgts'] = 0;
        (isset($dadosForm['cl_simples'])) ? $dadosForm['cl_simples'] = 1 : $dadosForm['cl_simples'] = 0;
        (isset($dadosForm['cl_darf_prolabore'])) ? $dadosForm['cl_darf_prolabore'] = 1 : $dadosForm['cl_darf_prolabore'] = 0;
        (isset($dadosForm['cl_cont_sindical'])) ? $dadosForm['cl_cont_sindical'] = 1 : $dadosForm['cl_cont_sindical'] = 0;
        (isset($dadosForm['controla_obrigacoes'])) ? $dadosForm['controla_obrigacoes'] = 1 : $dadosForm['controla_obrigacoes'] = 0;


        //Cria um novo usuário
        $this->clientes->create($dadosForm);

        //Redireciona para a rota de listagens
        return redirect('painel/clientes');
    }

    //*********************************************************************
    //*********************************************************************
    //Exibe o formulário para edição
    public function getEditar($cpf_cnpj) {
        $clientes = $this->clientes->where('cpf_cnpj', $cpf_cnpj)->first();

        //Busca as formas de tributação
        $formasTributacao = $this->forma_tributacao->get(['id', 'nome']);
        //$formasTributacao = $this->forma_tributacao->list('id', 'nome');
        return view('painel.forms.cadClientes', compact('clientes', 'cpf_cnpj', 'formasTributacao'));
    }

    //*********************************************************************
    //Salva os dados alterados
    public function postEditar(Request $request, $cpf_cnpj) {
        $dadosForm = $request->except('_token', 'salvar');

        //Verifica se os checkBox estão marcados
        (isset($dadosForm['cl_fl_pagto'])) ? $dadosForm['cl_fl_pagto'] = 1 : $dadosForm['cl_fl_pagto'] = 0;
        (isset($dadosForm['cl_gps'])) ? $dadosForm['cl_gps'] = 1 : $dadosForm['cl_gps'] = 0;
        (isset($dadosForm['cl_fgts'])) ? $dadosForm['cl_fgts'] = 1 : $dadosForm['cl_fgts'] = 0;
        (isset($dadosForm['cl_simples'])) ? $dadosForm['cl_simples'] = 1 : $dadosForm['cl_simples'] = 0;
        (isset($dadosForm['cl_darf_prolabore'])) ? $dadosForm['cl_darf_prolabore'] = 1 : $dadosForm['cl_darf_prolabore'] = 0;
        (isset($dadosForm['cl_cont_sindical'])) ? $dadosForm['cl_cont_sindical'] = 1 : $dadosForm['cl_cont_sindical'] = 0;
        (isset($dadosForm['controla_obrigacoes'])) ? $dadosForm['controla_obrigacoes'] = 1 : $dadosForm['controla_obrigacoes'] = 0;

        //Persiste a alteração no banco
        $this->clientes->where('cpf_cnpj', $cpf_cnpj)->update($dadosForm);

        //Redireciona para a rota de listagens
        return redirect('painel/clientes');
    }

    //Rota não encontrada
    public function missingMethod($params = array()) {
        return 'Erro 404, página não encontrada';
    }

}
