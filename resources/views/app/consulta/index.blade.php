@extends('app.layouts.basico')

@section('titulo', 'Consulta')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Listagem de consultas</p>
   </div>

   @include('app.layouts._partials.botao_adicionar', ['rota'=>'consulta.create'])
   
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