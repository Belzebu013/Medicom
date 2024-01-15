<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Especialidade;
use App\Models\Medico;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultas = DB::table('consultas')
                    ->join('pacientes', 'pacientes.id', '=', 'consultas.paciente_id')
                    ->join('medicos', 'medicos.id', '=', 'consultas.medico_id')
                    ->select('consultas.*', 'pacientes.nome as nome_paciente', 'medicos.nome as nome_medico')
                    ->get();
        foreach ($consultas as $consulta) {
            $consulta->data_hora_consulta = Carbon::createFromFormat('Y-m-d H:i:s', $consulta->data_hora_consulta)->format('d/m/Y H:i:s');
            $consulta->data_agendamento = Carbon::createFromFormat('Y-m-d', $consulta->data_agendamento)->format('d/m/Y');

        }
        return view('app.consulta.index', ['consultas' => $consultas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('app.consulta.create', ['especialidades'=> $especialidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('formsalvar')){
            $dataAgendamentoBanco = Carbon::createFromFormat('d/m/Y', $request->input('data_agendamento'))->format('Y-m-d');
            $datahoraConsultaBanco = Carbon::createFromFormat('n/j/Y, g:i:s A', $request->input('data_hora_consulta'))->format('Y-m-d H:i:s');
            Consulta::create([
                'paciente_id' => $request->input('paciente_id'),
                'medico_id' => $request->input('medico_id'),
                'data_agendamento' => $dataAgendamentoBanco,
                'hora_agendamento' => $request->input('hora_agendamento'),
                'data_hora_consulta' => $datahoraConsultaBanco,
            ]);

            $consultas = DB::table('consultas')
                ->join('pacientes', 'pacientes.id', '=', 'consultas.paciente_id')
                ->join('medicos', 'medicos.id', '=', 'consultas.medico_id')
                ->select('consultas.*', 'pacientes.nome as nome_paciente', 'medicos.nome as nome_medico')
                ->get();

            foreach ($consultas as $consulta) {
                $consulta->data_hora_consulta = Carbon::createFromFormat('Y-m-d H:i:s', $consulta->data_hora_consulta)->format('d/m/Y H:i:s');
                $consulta->data_agendamento = Carbon::createFromFormat('Y-m-d', $consulta->data_agendamento)->format('d/m/Y');

            }           
            return view('app.consulta.index', ['consultas' => $consultas]);
        }

        if(!empty($request->get('especialidade_id'))){
            $especialidade = Especialidade::where('nome', 'LIKE', 'Pediatria')
                                        ->orWhere('nome', 'LIKE', 'Pediatra')
                                        ->first();
            return $especialidade->id;
        }

        if(!empty($request->get('cpf'))){
            $pacientes = Paciente::where('cpf', 'LIKE', "%".$request->get('cpf')."%")
                                ->orWhere('cpf_responsavel', 'LIKE', "%".$request->get('cpf')."%")
                                ->get();
            return $pacientes;
        }

        if(!empty($request->get('paciente'))){
                $paciente = Paciente::find($request->get('paciente'));
                return $paciente;
        }
        
        if(!empty($request->get('medico'))){
            $medico = Medico::find($request->get('medico'));
            return $medico;
        }

        if (empty($request->get('crm')) && is_null($request->get('especialidade'))) {
            return collect();
        }

        $query = Medico::query();

        if (!empty($request->get('crm')) && is_null($request->get('especialidade'))) {
            // Pesquisar por CRM
            $query->where('crm', $request->get('crm'))
                ->join('especialidades', 'especialidades.id', '=', 'medicos.especialidade_id');
        } elseif (is_null($request->get('crm')) && !is_null($request->get('especialidade'))) {
            // Pesquisar por Especialidade
            $query->where('especialidades.id', $request->get('especialidade'))
                ->join('especialidades', 'especialidades.id', '=', 'medicos.especialidade_id');
        } elseif (!empty($request->get('crm')) && !is_null($request->get('especialidade'))) {
            // Pesquisar por CRM e Especialidade
            $query->where('crm', $request->get('crm'))
                ->where('especialidades.id', $request->get('especialidade'))
                ->join('especialidades', 'especialidades.id', '=', 'medicos.especialidade_id');
        }
        $medicos = $query->get(['medicos.*', 'especialidades.nome as nome_especialidade']);
     
        return $medicos;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consulta::find($id)->delete();
        $consultas = DB::table('consultas')
                ->join('pacientes', 'pacientes.id', '=', 'consultas.paciente_id')
                ->join('medicos', 'medicos.id', '=', 'consultas.medico_id')
                ->select('consultas.*', 'pacientes.nome as nome_paciente', 'medicos.nome as nome_medico')
                ->get();
        return view('app.consulta.index', ['consultas' => $consultas]);
    }
}
