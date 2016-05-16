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
    
      
}
