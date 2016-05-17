<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obrigacao extends Model
{
    protected $fillable = [
        'cpf_cnpj', 'mes', 'ano'
    ]; 
}
