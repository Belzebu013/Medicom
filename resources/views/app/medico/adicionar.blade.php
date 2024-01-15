@extends('app.layouts.basico')

@section('titulo', 'Médico')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Adicionar Médicos</p>
   </div>

   <div class="menu">
      <ul>
         <li><a href="{{ route('paciente.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
          </svg> Voltar</a></li>
      </ul>
   </div>

   <div class="informacao-pagina">
      <div class="container" style="width: 30%;">
         <form method="post" action="{{route('medico.store')}}">
            <input type="hidden" name="id" value="{{ $medico->id ?? ''}}">
            @csrf

            <div class="mb-3" style="text-align: left">
               <label for="nome" class="form-label">Nome</label>
               <input type="text" name="nome" value="{{ $medico->nome ??  old('nome')}}" class="form-control">
            </div>
               
            <div class="mb-3" style="text-align: left">
               <label for="crm" class="form-label">CRM</label>
               <input type="number" name="crm" value="{{ $medico->crm ?? old('crm')}}" class="form-control">
               <div class="text-danger">{{ $errors->has('crm') ? $errors->first('crm') : ''}}</div>
            </div>

            <div class="mb-3" style="text-align: left">
               <label for="especialidade" class="form-label">Especialidade</label>
               <select name="especialidade_id" class="form-control">
                  <option value="" style="text-align: center" disabled selected>-- Selecione a Especialidade --</option>
                  @foreach ($especialidades as $especialidade)
                     <option value="{{ $especialidade->id }}" {{old('especialidade_id') == $especialidade->id  ? 'selected' : ''}}>{{ $especialidade->nome }}</option>
                  @endforeach
               </select>
            </div>

            <button type="submit" class="btn btn-dark">Cadastrar</button>
         </form>
      </div>
   </div>
</div> 

@endsection