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
                        {{$errors->has('name') ? $errors->first('name') : ''}}
                        @if($errors->has('name'))</br></br>@endif
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                        {{$errors->has('email') ? $errors->first('email') : ''}}
                        @if($errors->has('email'))</br></br>@endif
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        {{$errors->has('password') ? $errors->first('password') : ''}}
                    </div>

                    <button type="submit" class="btn btn-dark">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>