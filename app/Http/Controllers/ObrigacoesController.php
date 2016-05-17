<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Obrigacao;

class ObrigacoesController extends Controller
{
    
    private $Obrigacoes;
    
    public function __construct(Obrigacao $Obrigacoes) {
        $this->Obrigacoes = $Obrigacoes;
     
    }
    
    public function getIndex(){
        //Variáveis mês e ano atual
        $mesAtual = isset($mes) ? $mes : (int) date('m');      
        $anoAtual = (int) date('Y');
        
        //Filtra as obrigações do mês
        $obrigacoes = $this->Obrigacoes
                ->where('mes', '=', $mesAtual)
                ->where('ano', '=', $anoAtual)
                ->join('clientes', 'clientes.cpf_cnpj', '=', 'obrigacaos.cpf_cnpj')                
                ->get();        
       
        
        return view('painel.listagens.obrigacoes', compact('mesAtual', 'anoAtual', 'obrigacoes') );
    }
    
    public function postEditar(Request $request, $cpf_cnpj, $mes, $ano){
        $dadosForm = $request->except('_token', 'salvar');
        
         //Verifica se os checkBox estão marcados
        (isset($dadosForm['fl_pagto']))         ? $dadosForm['fl_pagto'] = 1 : $dadosForm['fl_pagto'] = 0;
        (isset($dadosForm['gps']))              ? $dadosForm['gps'] = 1 : $dadosForm['gps'] = 0;
        (isset($dadosForm['fgts']))             ? $dadosForm['fgts'] = 1 : $dadosForm['fgts'] = 0;
        (isset($dadosForm['simples']))          ? $dadosForm['simples'] = 1 : $dadosForm['simples'] = 0;
        (isset($dadosForm['darf_prolabore']))   ? $dadosForm['darf_prolabore'] = 1 : $dadosForm['darf_prolabore'] = 0;
        (isset($dadosForm['cont_sindical']))    ? $dadosForm['cont_sindical'] = 1 : $dadosForm['cont_sindical'] = 0;
        
        //Persiste a alteração no banco
        $this->Obrigacoes->where('cpf_cnpj', $cpf_cnpj)
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->update($dadosForm);
        
        return  redirect('painel/obrigacoes');
        
    }
    
      
}
