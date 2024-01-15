<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    
     /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 
        'cpf',
        'nome_responsavel',
        'cpf_responsavel',
        'telefone', 
        'data_nascimento',
        'email',
        'cep',
        'endereco',
        'numero'
    ];
}
