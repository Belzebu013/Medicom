<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;


class EspecialidadeController extends Controller
{    
    /**
     * Exibe a página principal com a lista de especialidades.
     *
     * @return void
     */
    public function index()
    {
        $especialidades = Especialidade::get();
        return view('app.especialidade.listar', ['especialidades' => $especialidades, 'erro'=>0]);
    }
    
    /**
     * Exibe o formulário para adicionar uma nova especialidade.
     *
     * @return void
     */
    public function create()
    {
        $especialidades = Especialidade::get();
        return view('app.especialidade.adicionar', ['especialidades'=>$especialidades]);
    }
    
    /**
     * Armazena uma nova especialidade no banco de dados.
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:80',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'minimo de 3 caracteres',
            'nome.max' => 'max de 80 caracteres',
        ];
        $request->validate($regras, $feedback);
        Especialidade::create($request->all());

        return redirect()->route('especialidade.index');
    }
    
    /**
     * Exclui uma especialidade do banco de dados.
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $especialidades = Especialidade::get();
        try {
            $especialidade = Especialidade::findOrFail($id);
    
            if ($especialidade->medicos->isEmpty()) {
                $especialidade->delete();
            } else {
                return view('app.especialidade.listar', ['especialidades' => $especialidades, 'erro'=>1]);
            }
        } catch (\Exception $e) {
            return view('app.especialidade.listar', ['especialidades' => $especialidades, 'erro'=>1]);
        }
    
        return redirect()->route('especialidade.index');
    }
}
