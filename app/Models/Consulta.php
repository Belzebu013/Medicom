<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

     /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'medico_id',
        'paciente_id',
        'data_agendamento',
        'hora_agendamento',
        'data_hora_consulta',
    ];
    
    /**
     * Define o relacionamento com a tabela de médicos.
     *
     * @return void
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
    
    /**
     * Define o relacionamento com a tabela de pacientes.
     *
     * @return void
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
