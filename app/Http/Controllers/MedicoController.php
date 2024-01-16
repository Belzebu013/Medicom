<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidade;
use App\Models\Consulta;

class MedicoController extends Controller
{
    
    /**
     * Exibe a página principal com a lista de médicos.
     *
     * @return void
     */
    public function index()
    {
        $medicos = Medico::get();
        return view('app.medico.listar', ['medicos' => $medicos, 'erro' => 0]);
    }
    
    /**
     * Exibe o formulário para adicionar um novo médico.
     *
     * @return void
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('app.medico.adicionar', ['especialidades' => $especialidades, 'erro'=>0]);
    }
    
    /**
     * Armazena um novo médico no banco de dados.
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:80',
            'crm' => 'required',
            'especialidade_id' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'minimo de 3 caracteres',
            'nome.max' => 'max de 80 caracteres'
        ];
        
        $request->validate($regras, $feedback);

        $crm_ja_cadastrado = Medico::where('crm', 'LIKE', $request->input('crm'))->get();
        if($crm_ja_cadastrado->isEmpty()){
            $especialidade = Especialidade::find($request->input('especialidade_id'));
            Medico::create([
                'nome' => $request->input('nome'),
                'crm' => $request->input('crm'),
                'especialidade_id' => $especialidade->id
            ]);
        }else{
            $especialidades = Especialidade::all();
            return view('app.medico.adicionar', ['especialidades' => $especialidades, 'erro'=>1]);
        }

        return redirect()->route('medico.index');
    }

    public function destroy($id)
    {
        $medicos = Medico::get();
        try {
            $medico_consulta = Consulta::where('medico_id', $id)->get();
            if ($medico_consulta->isEmpty()) {
                Medico::find($id)->delete();
            } else {
                return view('app.medico.listar', ['medicos' => $medicos, 'erro' => 1]);
            }
        } catch (\Exception $e) {
            return view('app.medico.listar', ['medicos' => $medicos, 'erro' => 1]);
        }
    
        return redirect()->route('medico.index');
    }
}
