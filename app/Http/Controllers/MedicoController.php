<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidade;

class MedicoController extends Controller
{
    
    /**
     * Exibe a página principal com a lista de médicos.
     *
     * @return void
     */
    public function index()
    {
        $medico = Medico::get();
        return view('app.medico.listar', ['medicos' => $medico]);
    }
    
    /**
     * Exibe o formulário para adicionar um novo médico.
     *
     * @return void
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('app.medico.adicionar', ['especialidades' => $especialidades]);
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
        $especialidade = Especialidade::find($request->input('especialidade_id'));
        Medico::create([
            'nome' => $request->input('nome'),
            'crm' => $request->input('crm'),
            'especialidade_id' => $especialidade->id
        ]);

        return redirect()->route('medico.index');
    }
    
    /**
     * Exclui um médico do banco de dados.
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        Medico::find($id)->delete();
        return redirect()->route('medico.index');
    }
}
