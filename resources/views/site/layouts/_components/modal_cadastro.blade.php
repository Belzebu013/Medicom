<div class="modal" id="modalCadastro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastro</h4>
                <button type="button" class="close btn-light" style="margin-top: -0.5rem; margin-right: -1rem; margin-bottom: -1rem; margin-left: auto; width: 20%;" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('site.cadastrar') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div style="text-align: center" id="nameMsgError"></div>
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <div style="text-align: center" id="emailMsgError"></div>
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div style="text-align: center" id="passwordMsgError"></div>
                    </div>
                    <button type="submit" class="btn btn-dark" onclick="realizarCadastro(event)">Cadastrar</button>
                </form>
                <div style="text-align: center;" id="div_mensagem"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function realizarCadastro(event){
        event.preventDefault();
        var erro_form = false;
        $('#nameMsgError, #emailMsgError, #passwordMsgError').html('');
        $('#name, #email, #password').removeClass('is-invalid');
        if (!/@/.test($('#email').val())){
            $('#email').addClass('is-invalid');
            $('#emailMsgError').html('Email inválido');
            erro_form = true;
        }
        if($('#name').val() == ''){
            $('#name').addClass('is-invalid');
            $('#nameMsgError').html('Campo nome obrigatório');
            erro_form = true;
        }
        if($('#email').val() == ''){
            $('#email').addClass('is-invalid');
            $('#emailMsgError').html('Campo email obrigatório');
            erro_form = true;
        }
        if($('#password').val() == ''){
            $('#password').addClass('is-invalid');
            $('#passwordMsgError').html('Campo senha obrigatório');
            erro_form = true;
        }
        if(!erro_form){
            $.ajax({
                type: 'POST',
                url: '{{ route("site.cadastrar") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val()
                },
                success: function (data) {
                    $('#div_mensagem').html(data);
                    $('#name, #email, #password').val('');
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    $('#div_mensagem').html('Ocorreu um erro durante o cadastro, por favor tente novamente em breve.');
                }
            });
        }
    }
</script>