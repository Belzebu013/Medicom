<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{    
    /**
     * Exibe a página inicial do sistema com a lista de consultas agendadas.
     *
     * @return void
     */
    public function Index(){
        $consultas = DB::table('consultas')
                    ->join('pacientes', 'pacientes.id', '=', 'consultas.paciente_id')
                    ->join('medicos', 'medicos.id', '=', 'consultas.medico_id')
                    ->select('consultas.*', 'pacientes.nome as nome_paciente', 'medicos.nome as nome_medico')
                    ->orderBy('consultas.data_agendamento', 'asc')
                    ->get();
        foreach ($consultas as $consulta) {
            $consulta->data_agendamento = Carbon::createFromFormat('Y-m-d', $consulta->data_agendamento)
                ->format('d/m/Y');
        }
        return view('app.home', ['consultas' => $consultas]);
    }
}
