<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Obrigacao;
use App\Cliente;

class ObrigacoesController extends Controller {

    private $Obrigacoes;
    private $Clientes;

    public function __construct(Obrigacao $Obrigacoes, Cliente $clientes) {
        $this->Obrigacoes = $Obrigacoes;
        $this->Clientes = $clientes;
    }

    public function getIndex($mes = null, $ano = null) {
        //Variáveis mês e ano atual
        $mesAtual = isset($mes) ? $mes : (int) date('m');
        $anoAtual = (int) date('Y');

        //Filtra as obrigações do mês
        $obrigacoes = $this->Obrigacoes
                ->where('mes', $mesAtual)
                ->where('ano', $anoAtual)
                ->where('controla_obrigacoes', 1)
                ->join('clientes', 'clientes.cpf_cnpj', '=', 'obrigacaos.cpf_cnpj')
                ->orderBy('nome_razaosocial')
                ->get()
                ->toArray();
        
        //Retorna um array com a relação de CNPJ que estão ausentes da listagem de obrigações
        //esta função é para evitar que um cliente cadastrado anteriormente a geração da lista
        //não apareça nesta listagem
        $atualizarObrigacoes = $this->getVerificaObrigacoes($mesAtual, $anoAtual);
        $qtdObrigacoes = count($atualizarObrigacoes);

        return view('painel.listagens.obrigacoes', compact('mesAtual', 
                'anoAtual', 
                'obrigacoes', 
                'atualizarObrigacoes',
                'qtdObrigacoes'
                ));
    }

    public function postEditar(Request $request, $cpf_cnpj, $mes, $ano) {
        $dadosForm = $request->except('_token', 'salvar');

        //Verifica se os checkBox estão marcados
        (isset($dadosForm['fl_pagto'])) ? $dadosForm['fl_pagto'] = 1 : $dadosForm['fl_pagto'] = 0;
        (isset($dadosForm['gps'])) ? $dadosForm['gps'] = 1 : $dadosForm['gps'] = 0;
        (isset($dadosForm['fgts'])) ? $dadosForm['fgts'] = 1 : $dadosForm['fgts'] = 0;
        (isset($dadosForm['simples'])) ? $dadosForm['simples'] = 1 : $dadosForm['simples'] = 0;
        (isset($dadosForm['darf_prolabore'])) ? $dadosForm['darf_prolabore'] = 1 : $dadosForm['darf_prolabore'] = 0;
        (isset($dadosForm['cont_sindical'])) ? $dadosForm['cont_sindical'] = 1 : $dadosForm['cont_sindical'] = 0;

        //Persiste a alteração no banco
        $this->Obrigacoes->where('cpf_cnpj', $cpf_cnpj)
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->update($dadosForm);

        return redirect('painel/obrigacoes');
    }

    public function getGerarObrigacoes($mes, $ano) {

        $clientes = $this->Clientes
                ->where('controla_obrigacoes', '1')
                ->get()
                ->toArray();

        $obrigacoes = $this->Obrigacoes
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->get()
                ->toArray();


        if (!$obrigacoes) {
            foreach ($clientes as $cliente) {
                Obrigacao::create(['cpf_cnpj' => $cliente['cpf_cnpj'], 'mes' => $mes, 'ano' => $ano]);
            } 
        } else {
            $NovosCadastros = $this->getVerificaObrigacoes($mes, $ano);            
            foreach ($NovosCadastros as $cliente) {                
                Obrigacao::create(['cpf_cnpj' => $cliente, 'mes' => $mes, 'ano' => $ano]);                
            }
            
        }
        
        return back();
    }

    public function getVerificaObrigacoes($mes, $ano) {
        
        $clientes = $this->Clientes
                ->select('cpf_cnpj')
                ->where('controla_obrigacoes', '1')
                ->get()
                ->toArray();

        $obrigacoes = $this->Obrigacoes
                ->select('cpf_cnpj')
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->get()
                ->toArray();


        $teste1 = array_simples($clientes);
        $teste2 = array_simples($obrigacoes);
        
        if ($teste1 && $teste2)
        return array_diff($teste1, $teste2);
    }

}
