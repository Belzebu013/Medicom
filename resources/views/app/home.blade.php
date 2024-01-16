@extends('app.layouts.basico')

@section('titulo', 'Home')

@section('conteudo')
<div class="conteudo-pagina">
   <div class="titulo-pagina-2"><p>Consultas Agendadas</p></div>
   @if(!$consultas->isEmpty())
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="row row-cols-1 row-cols-md-2 g-4">
                  @foreach($consultas as $consulta)
                     <div class="col" style="width: 33.33%;" style="background-color: #2a9ee2">
                        <div class="card" style="border: 1px solid #2a9ee2;">                           
                           <div class="card-body">
                              <p class="card-title">{{$consulta->id}}</p>
                              <h5 class="card-text">Paciente: <strong>{{$consulta->nome_paciente}}</strong></h5>
                              <h5 class="card-text">Médico: {{$consulta->nome_medico}}</h5>
                              <h5 class="card-text">Data: {{$consulta->data_agendamento.' - '.$consulta->hora_agendamento}}</h5>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   @else
      <div>Nenhuma consulta agendada</div>
   @endif
</div>
@endsection