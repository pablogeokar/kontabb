<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable {

    
    
    protected $fillable = [
        'cpf_cnpj', 'nome_razaosocial', 'cpf_responsavel', 'nome_responsavel',
        'codigo_simplesnacional', 'email', 'password', 'id_forma_tributacao', 'login_sefaz_ba',
        'senha_sefaz_ba', 'cl_fl_pagto', 'cl_gps', 'cl_fgts', 'cl_simples', 'cl_darf_prolabore',
        'cl_cont_sindical', 'controla_obrigacoes', 'remember_token'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

}
