@extends('app.layouts.basico')

@section('titulo', 'Especialidade')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Adicionar Especialidades</p>
   </div>
   
   @include('app.layouts._partials.botao_voltar', ['rota'=>'especialidade.index'])

   <div class="informacao-pagina">
      <div class="container" style="width: 30%;">
         <form method="post" action="{{route('especialidade.store')}}">
            <input type="hidden" name="id" value="{{ $especialidade->id ?? ''}}">
            @csrf
            <div class="mb-3 alinhamento-esquerda">
               <label for="nome" class="form-label">Nome</label>
               <input type="text" name="nome" value="{{ $especialidade->nome ??  old('nome')}}" class="form-control">
            </div>
            <div class="text-danger">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</div>
            @if($erro)
               <div class="text-danger">Especialidade ja cadastrada!</div>
            @endif
            <button type="submit" class="btn btn-dark">Cadastrar</button>
         </form>
      </div>
   </div>
</div> 

@endsection