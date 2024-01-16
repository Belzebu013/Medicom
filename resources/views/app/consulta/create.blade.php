@extends('app.layouts.basico')

@section('titulo', 'consulta')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
         <p>Adicionar consulta</p> 
   </div>

   @include('app.layouts._partials.botao_adicionar', ['rota'=>'consulta.index'])
   
   <div class="informacao-pagina">
      <div class="margem" style="width: 50%;">

        @component('app.consulta._components.form_create_edit', ['especialidades'=> $especialidades])
        @endcomponent

      </div>
   </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection