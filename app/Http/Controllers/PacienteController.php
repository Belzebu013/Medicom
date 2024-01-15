<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
        
    /**
     * Exibe a página principal com a lista de pacientes.
     *
     * @param  mixed $request
     * @return void
     */
    public function Index(Request $request)
    {
        $pacientes = Paciente::get();
        return view('app.paciente.index', ['pacientes' => $pacientes, 'request' => $request->all()]);
    }

       
    /**
     * Exibe o formulário para criar um novo paciente.
     *
     * @return void
     */
    public function create()
    {
        return view('app.paciente.create');
    }

       
    /**
     * Armazena um novo paciente no banco de dados.
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        if(empty($request->input('cpf_responsavel'))){
            $cpf_validate = "cpf";
            $cpf_responsavel = null;
            $nome_responsavel = null;
            $cpf = $request->input('cpf');
        }else{
            $cpf_validate = "cpf_responsavel";
            $cpf = null;
            $cpf_responsavel = $request->input('cpf_responsavel');
            $nome_responsavel = $request->input('nome_responsavel');
        }
        $regras = [
            'nome' => 'required|min:3|max:80',
            $cpf_validate => 'required',
            'email' => 'required',
            'cep' => 'required', 
            'endereco' => 'required',
            'numero' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'minimo de 3 caracteres',
            'nome.max' => 'max de 80 caracteres',
        ];
        $request->validate($regras, $feedback);
        Paciente::create([
            'nome' => $request->input('nome'),
            'cpf' => $cpf,
            'nome_responsavel' => $nome_responsavel,
            'cpf_responsavel' => $cpf_responsavel,
            'data_nascimento' => $request->input('data_nascimento'),
            'telefone' => $request->input('telefone'),
            'email' => $request->input('email'),
            'cep' => $request->input('cep'),
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
        ]);

        return redirect()->route('paciente.index');
    }

        
    /**
     * Exibe as informações detalhadas de um paciente específico.
     *
     * @param  mixed $id - ID do paciente.
     * @return void
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        return view('app.paciente.show', ['paciente' => $paciente]);
    }

        
    /**
     * Exclui um paciente do banco de dados.
     *
     * @param  mixed $id - ID do paciente a ser excluído.
     * @return void
     */
    public function destroy($id)
    {
        Paciente::find($id)->delete();
        return redirect()->route('paciente.index');
    }
}
