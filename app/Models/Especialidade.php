<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;
    
    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = ['nome'];
        
    /**
     * Define o relacionamento com a tabela de médicos.
     *
     * @return void
     */
    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }
}
