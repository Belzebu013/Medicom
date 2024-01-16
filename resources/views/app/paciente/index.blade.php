@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Listagem de Pacientes</p>
   </div>
   
   @include('app.layouts._partials.botao_adicionar', ['rota'=>'paciente.create'])
   
   <div class="informacao-pagina">
      <div class="margem" style="width: 90%;">
        @if(!$pacientes->isEmpty())
            <table border="1" style="width: 100%;" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <td>{{$paciente->id}}</td>
                            <td>{{$paciente->nome}}</td>
                            <td><a href="{{ route('paciente.show', ['paciente' => $paciente->id])}}">Visualizar</a></td>
                            <td>
                                <form id="form_{{$paciente->id}}" method="POST" action="{{route('paciente.destroy', ['paciente' => $paciente->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#" onclick="document.getElementById('form_{{$paciente->id}}').submit()">Excluir</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div>Nenhum registro cadastrado</div>
        @endif
        @if($erro)
            <div class="text-danger">Não é possível excluir o paciente, pois está associado a pelo menos uma consulta</div>
        @endif
      </div>
   </div>
</div> 

@endsection