<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidade;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medico = Medico::get();
        return view('app.medico.listar', ['medicos' => $medico]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('app.medico.adicionar', ['especialidades' => $especialidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medico::find($id)->delete();
        return redirect()->route('medico.index');
    }
}
