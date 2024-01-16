@extends('app.layouts.basico')

@section('titulo', 'Especialidades')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Especialidades</p>
   </div>

   @include('app.layouts._partials.botao_adicionar', ['rota'=>'especialidade.create'])
   
   <div class="informacao-pagina">
      <div class="margem" style="width: 70%;">
        @if(!$especialidades->isEmpty())
            <table border="1" style="width: 100%;" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($especialidades as $especialidade)
                        <tr>
                            <td>{{$especialidade->id}}</td>
                            <td>{{$especialidade->nome}}</td>
                            <td>
                                <form id="form_{{$especialidade->id}}" method="POST" action="{{route('especialidade.destroy', ['especialidade' => $especialidade->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#" onclick="document.getElementById('form_{{$especialidade->id}}').submit()">Excluir</a>
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
            <div class="text-danger">Não é possível excluir a especialidade, pois está associada a pelo menos um médico</div>
        @endif
      </div>
   </div>
</div> 

@endsection