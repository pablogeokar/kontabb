<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   protected $fillable = [
        'cpf_cnpj', 'nome_razaosocial', 'cpf_responsavel', 'nome_responsavel',
       'codigo_simplesnacional', 'email', 'password', 'id_forma_tributacao', 'login_sefaz_ba',
       'senha_sefaz_ba'
    ];
}
