@extends('app.layouts.basico')

@section('titulo', 'Paciente')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Visualizar paciente</p>
   </div>

   <div class="menu">
      <ul>
         <li><a href="{{ route('paciente.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
          </svg> Voltar</a></li>
      </ul>
   </div>
   
   <div class="informacao-pagina" style="width: 100%; display: flex; justify-content: center; align-items: center;">
      <div style="width: 400px; margin-top: 30px;">
         <table border="1" style="text-align: left;" class="table table-hover">
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
                  <td>Endereço:</td>
                  <td>{{ $paciente->endereco}}</td>
               </tr>
               <tr>
                  <td>Cep:</td>
                  <td>{{ $paciente->cep}}</td>
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