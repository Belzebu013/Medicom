@extends('app.layouts.basico')

@section('titulo', 'Paciente')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Visualizar paciente</p>
   </div>

   @include('app.layouts._partials.botao_voltar', ['rota'=>'paciente.index'])

   <div class="informacao-pagina alinhar-centro-div">
      <div style="width: 400px; margin-top: 30px;">
         <table border="1" class="table table-hover alinhamento-esquerda">
            <tr>
               <td>ID:</td>
               <td>{{ $paciente->id}}</td>
            </tr>
            <tr>
               <td>Nome:</td>
               <td>{{ $paciente->nome}}</td>
            </tr>
            <tr>
               <td>{{ !empty($paciente->cpf_responsavel) ? 'Cpf do responsável' : 'Cpf'}}:</td>
               <td>{{ !empty($paciente->cpf_responsavel) ? $paciente->cpf_responsavel : $paciente->cpf}}</td>
            </tr>
            @if(!empty($paciente->nome_responsavel))
               <tr>
                  <td>Nome do responsável:</td>
                  <td>{{$paciente->nome_responsavel}}</td>
               </tr>
            @endif
            <tr>
               <td>Data de nascimento:</td>
               <td>{{ \Carbon\Carbon::parse($paciente->data_nascimento)->format('d/m/Y') }}</td>
            </tr>
            <tr>
               <td>Telefone:</td>
               <td>{{ $paciente->telefone}}</td>
            </tr>
            <tr>
               <td>Cep:</td>
               <td>{{ $paciente->cep}}</td>
            </tr>
            <tr>
               <td>Endereço:</td>
               <td>{{ $paciente->endereco}}</td>
            </tr>
            <tr>
               <td>Número:</td>
               <td>{{ $paciente->numero}}</td>
            </tr>
         </table>
      </div>
   </div>
</div> 

@endsection