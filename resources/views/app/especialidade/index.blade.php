@extends('app.layouts.basico')

@section('titulo', 'Médicos')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Médicos</p>
   </div>
   
   @include('app.layouts._partials.botao_adicionar', ['rota'=>'medico.create'])
   
   <div class="informacao-pagina">
      <div class="alinhar-tabela">
         <form method="post" action="{{route('medico.index')}}">
            @csrf
            <input type="text" name="nome" placeholder="Nome" class="borda-preta">
            <input type="text" name="site" placeholder="Site" class="borda-preta">
            <input type="text" name="uf" placeholder="UF" class="borda-preta">
            <input type="text" name="email" placeholder="Email" class="borda-preta">
            <button type="submit" class="borda-preta">Pesquisar</button>
         </form>
      </div>
   </div>
</div> 

@endsection