<div class="topo">

<div class="logo">
    <a href="{{ route('app.home') }}"><img src="{{asset('img/medcom.svg')}}" style="width: 100px; height: 50px;"></a>
</div>

<div class="menu">
    <ul>
        <li><a href="{{ route('app.home') }}">Home</a></li>
        <li><a href="{{ route('consulta.index') }}">Consultas</a></li>
        <li><a href="{{ route('paciente.index') }}">Pacientes</a></li>
        <li><a href="{{ route('medico.index') }}">Médicos</a></li>
        <li><a href="{{ route('especialidade.index') }}">Especialidades</a></li>
        <li><a href="{{ route('app.sair') }}">Sair</a></li>
    </ul>
</div>
</div>