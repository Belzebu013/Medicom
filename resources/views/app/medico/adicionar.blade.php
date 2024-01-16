@extends('app.layouts.basico')

@section('titulo', 'Médico')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Adicionar Médicos</p>
   </div>

   @include('app.layouts._partials.botao_voltar', ['rota'=>'paciente.index'])

   <div class="informacao-pagina">
      <div class="container" style="width: 30%;">
         <form method="post" action="{{route('medico.store')}}">
            <input type="hidden" name="id" value="{{ $medico->id ?? ''}}">
            @csrf

            <div class="mb-3 alinhamento-esquerda">
               <label for="nome" class="form-label">Nome</label>
               <input type="text" name="nome" value="{{ $medico->nome ??  old('nome')}}" class="form-control">
               <div class="text-danger">{{ $errors->has('nome') ? $errors->first('nome') : ''}}</div>
            </div>
               
            <div class="mb-3 alinhamento-esquerda">
               <label for="crm" class="form-label">CRM</label>
               <input type="number" name="crm" value="{{ $medico->crm ?? old('crm')}}" class="form-control">
               <div class="text-danger">{{ $errors->has('crm') ? $errors->first('crm') : ''}}</div>
            </div>

            <div class="mb-3 alinhamento-esquerda">
               <label for="especialidade" class="form-label">Especialidade</label>
               <select name="especialidade_id" class="form-control">
                  <option value="" style="text-align: center" disabled selected>-- Selecione a Especialidade --</option>
                  @foreach ($especialidades as $especialidade)
                     <option value="{{ $especialidade->id }}" {{old('especialidade_id') == $especialidade->id  ? 'selected' : ''}}>{{ $especialidade->nome }}</option>
                  @endforeach
               </select>
            </div>
            @if($erro)
               <div class="text-danger">CRM ja cadastrado!</div>
            @endif
            <button type="submit" class="btn btn-dark">Cadastrar</button>
         </form>
      </div>
   </div>
</div> 

@endsection