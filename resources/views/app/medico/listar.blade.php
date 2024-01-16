@extends('app.layouts.basico')

@section('titulo', 'Médicos')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Médicos</p>
   </div>

   @include('app.layouts._partials.botao_adicionar', ['rota'=>'medico.create'])
   
   <div class="informacao-pagina">
      <div class="margem" style="width: 90%;">
        @if(!$medicos->isEmpty())
            <table border="1" style="width: 100%;" class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CRM</th>
                        <th>Especialidade</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicos as $medico)
                        <tr>
                            <td>{{$medico->nome}}</td>
                            <td>{{$medico->crm}}</td>
                            <td>{{$medico->especialidade->nome}}</td>
                            <td>
                                <form id="form_{{$medico->id}}" method="POST" action="{{route('medico.destroy', ['medico' => $medico->id])}}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#" onclick="document.getElementById('form_{{$medico->id}}').submit()">Excluir</a>
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
            <div class="text-danger">Não é possível excluir o médico, pois está associado a pelo menos uma consulta</div>
        @endif
      </div>
   </div>
</div> 

@endsection