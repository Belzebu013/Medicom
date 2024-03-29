@extends('site.layouts.basico')

@section('titulo', 'Login')

@section('conteudo')
    <div class="container-fluid altura100">
        <div class="row altura100">
            <div class="col-md-8 p-0">
                <img src="{{ asset('img/wallpaper_login.png') }}" class="img-fluid w-100 altura100" alt="Imagem de Login">
            </div>
            <div class="col-md-4">
                <div style="display: flex; align-items: center; justify-content: center; margin-top: 100px"><a href="{{route('site.login')}}"><img src="{{asset('img/medcom.svg')}}" style="width: 50%px; height: 80px;"></a></div>
                <div class="informacao-pagina" style="margin-top: 20px;">
                    <div class="informacao-pagina">
                        <div class="margem" style="width: 80%;"> 
                            <form action="{{ route('site.autenticar') }}" method="post">
                                @csrf
                                <div class="mb-3 alinhamento-esquerda">
                                    <label for="usuario" style="margin-bottom: 0px" class="form-label">Usuário</label>
                                    <input name="usuario" value="{{ old('usuario') }}" type="text" class="form-control">
                                    <div class="text-danger">{{ $errors->has('usuario') ? $errors->first('usuario') : '' }}</div>
                                </div>
                                <div class="mb-3 alinhamento-esquerda">
                                    <label style="margin-bottom: 0px" for="password" class="form-label">Senha</label>
                                    <input name="password" value="{{ old('password') }}" type="password" class="form-control">
                                    <div class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</div>
                                </div>
                                <button type="submit" class="btn btn-dark">Acessar</button>
                            </form>
                            {{{isset($erro) && $erro != '' ? $erro : ''}}}
                            <div class="sem_cadastro">
                                <p>Ainda não é cadastrado?</p>
                                <a href="#" data-toggle="modal" data-target="#modalCadastro">Cadastrar-se</a>
                            </div> 
                        </div>
                    </div>             
                </div>
            </div>
        </div>
    </div>
    @include('site.layouts._components.modal_cadastro')
@endsection