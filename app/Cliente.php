<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   protected $fillable = [
        'cpf_cnpj', 'nome_razaosocial', 'cpf_responsavel', 'nome_responsavel',
       'codigo_simplesnacional', 'email', 'password', 'id_forma_tributacao', 'login_sefaz_ba',
       'senha_sefaz_ba', 'cl_fl_pagto', 'cl_gps', 'cl_fgts', 'cl_simples', 'cl_darf_prolabore',
       'cl_cont_sindical'
    ];
}
