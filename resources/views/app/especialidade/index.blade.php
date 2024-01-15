@extends('app.layouts.basico')

@section('titulo', 'Médicos')

@section('conteudo')

<div class="conteudo-pagina">
   <div class="titulo-pagina-2">
      <p>Médicos</p>
   </div>

   <div class="menu">
      <ul>
         <li><a href="{{route('medico.create')}}">Adicionar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg></a></li>
      </ul>
   </div>
   
   <div class="informacao-pagina">
      <div style="width: 30%; margin-left: auto; margin-right: auto;">
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