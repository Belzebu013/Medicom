@extends('app.layouts.basico')

@section('titulo', 'Consulta')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Listagem de consultas</p>
   </div>

   <div class="menu">
      <ul>
         <li><a href="{{ route('consulta.create')}}">Adicionar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg></a></li>
      </ul>
   </div>
   
   <div class="informacao-pagina">
      <div class="margem" style="width: 90%;">
        @if(!$consultas->isEmpty())
            <table border="1" style="width: 100%;"  class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Paciente</th>
                        <th>Médico</th>  
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Agendada em</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultas as $consulta)
                        <tr>
                            <td>{{$consulta->id}}</td>
                            <td>{{$consulta->nome_paciente}}</td>
                            <td>{{$consulta->nome_medico}}</td>
                            <td>{{$consulta->data_agendamento}}</td>
                            <td>{{$consulta->hora_agendamento}}</td>
                            <td>{{$consulta->data_hora_consulta ?? '' }}</td>
                            <td>
                                <form id="form_{{$consulta->id}}" method="POST" action="{{route('consulta.destroy', ['consultum' => $consulta->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#" onclick="document.getElementById('form_{{$consulta->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div>Nenhum registro cadastrado</div>
        @endif
      </div>
   </div>
</div> 

@endsection