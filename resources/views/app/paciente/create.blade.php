@extends('app.layouts.basico')

@section('titulo', 'Paciente')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
         <p>Adicionar Paciente</p> 
   </div>
   
   @include('app.layouts._partials.botao_adicionar', ['rota'=>'paciente.index'])
   
   <div class="informacao-pagina">
      <div class="margem" style="width: 50%;">

        @component('app.paciente._components.form_create_edit')
        @endcomponent

      </div>
   </div>
</div> 

@endsection