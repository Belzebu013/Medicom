<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = [
        'medico_id',
        'paciente_id',
        'data_agendamento',
        'hora_agendamento',
        'data_hora_consulta',
    ];

    // Relacionamento com a tabela de médicos
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }

    // Relacionamento com a tabela de pacientes
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
