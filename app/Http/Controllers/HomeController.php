<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Consulta;

class HomeController extends Controller
{    
    /**
     * Exibe a página inicial do sistema com a lista de consultas agendadas.
     *
     * @return void
     */
    public function Index(){
        $consultas = (new Consulta)->carregaConsultasDB();
        foreach ($consultas as $consulta) {
            $consulta->data_agendamento = Carbon::createFromFormat('Y-m-d', $consulta->data_agendamento)
                ->format('d/m/Y');
        }
        return view('app.home', ['consultas' => $consultas]);
    }
}
