@if(isset($paciente->id))
    <form method="post" action="{{ route('paciente.update', ['paciente' => $paciente->id]) }}">
        @csrf
        @method('PUT')
        @else
            <form method="post" action="{{ route('paciente.store')}}">
                @csrf
        @endif
        <div class="mb-3 alinhamento-esquerda">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $paciente->nome ?? old('nome')}}">
            <div class="text-danger">{{ $errors->has('nome') ? $errors->first('nome') : ''}}</div>
        </div>
        <div class="row mb-3 alinhamento-esquerda">
            <div class="col-md-6">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="{{ $paciente->data_nascimento ?? old('data_nascimento') }}">
            </div>
            <div class="col-md-6" id="cpf">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" id="cpf" name="cpf" maxlength="11" class="form-control" value="{{ $paciente->cpf ?? old('cpf')}}">
                <div class="text-danger">{{ $errors->has('cpf') ? $errors->first('cpf') : ''}}</div>
            </div>
            <div class="col-md-4 responsavel" style="display: none;">
                <label for="cpf_responsavel" class="form-label">CPF do Responsável</label>
                <input type="text" id="cpf_responsavel" name="cpf_responsavel" maxlength="11" class="form-control" value="{{ $paciente->cpf ?? old('cpf_responsavel')}}">
                <div class="text-danger">{{ $errors->has('cpf_responsavel') ? $errors->first('cpf_responsavel') : ''}}</div>
            </div>
            <div class="col-md-4 responsavel" style="display: none;">
                <label for="nome_responsavel" class="form-label">Nome do Responsável</label>
                <input type="text" id="nome_responsavel" name="nome_responsavel" class="form-control" value="{{ $paciente->cpf ?? old('nome_responsavel')}}">
                <div class="text-danger">{{ $errors->has('nome_responsavel') ? $errors->first('nome_responsavel') : ''}}</div>
            </div>
        </div>
        <div class="row mb-3 alinhamento-esquerda">
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $paciente->email ?? old('email')}}">
                <div class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ''}}</div>
            </div>
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" id="telefone" maxlength="11" name="telefone" class="form-control" value="{{ $paciente->telefone ?? old('telefone')}}">
                <div class="text-danger">{{ $errors->has('telefone') ? $errors->first('telefone') : ''}}</div>
            </div>
        </div>
        <div class="row mb-3 alinhamento-esquerda">
            <div class="col-md-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" name="cep" maxlength="8" class="form-control" value="{{ $paciente->cep ?? old('cep')}}">
            </div>
            <div class="col-md-4">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" value="{{ $paciente->endereco ?? old('endereco')}}" >
                <div class="text-danger">{{ $errors->has('endereco') ? $errors->first('endereco') : ''}}</div>
            </div>
            <div class="col-md-4">
                <label for="numero" class="form-label">Número</label>
                <input type="number" name="numero" class="form-control" value="{{ $paciente->numero ?? old('numero')}}">
                <div class="text-danger">{{ $errors->has('numero') ? $errors->first('numero') : ''}}</div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    
<script>
    $(document).ready(function () {
        $('input[name="cep"]').on('blur', function () {
            var cep = $(this).val();
            if(cep.length < 1)
                $('input[name="endereco"]').val('');
            if (cep.length >= 1 && !/^\d+$/.test(cep))
                alert('CEP inválido');
            cep = cep.replace(/\D/g, '');

            if (cep.length == 8) {
                $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                    if (!data.erro) {
                        $('input[name="endereco"]').val(data.logradouro);
                        $('input[name="numero"]').val('');
                        $('input[name="endereco"]').prop('readonly', true);
                    } else {
                        alert('CEP não encontrado');
                    }
                });
            }
        });

        $('#data_nascimento').on('change', function () {
            var dataNascimento = new Date($(this).val());
            var hoje = new Date();
            var idade = hoje.getFullYear() - dataNascimento.getFullYear();

            if (idade < 12) {
                $('#cpf').hide();
                $('#cpf').val('');
                $('#data_nascimento').parent('div').removeClass('col-md-6').addClass('col-md-4');
                $('.responsavel').show();
            } else {
                $('#cpf').show();
                $('#cpf_responsavel').val('');
                $('#nome_responsavel').val('');
                $('.responsavel').hide();
            }
        });
    });
</script>

