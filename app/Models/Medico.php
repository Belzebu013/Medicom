<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
        
    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 
        'especialidade_id',
        'crm'
    ];
    
    /**
     * Define o relacionamento com a tabela de especialidades.
     *
     * @return void
     */
    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class);
    }
}
