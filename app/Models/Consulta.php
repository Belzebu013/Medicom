<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    /**
     * Carrega as consultas do banco de dados, incluindo informações sobre pacientes e médicos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function carregaConsultasDB(){
        $consultas = DB::table('consultas')
                    ->join('pacientes', 'pacientes.id', '=', 'consultas.paciente_id')
                    ->join('medicos', 'medicos.id', '=', 'consultas.medico_id')
                    ->select('consultas.*', 'pacientes.nome as nome_paciente', 'medicos.nome as nome_medico')
                    ->get();

        return $consultas;
    }
}
