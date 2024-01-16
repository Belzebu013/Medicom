<!-- Modal de Pesquisa de Paciente -->
<div class="modal fade" id="pesquisaPacienteModal" tabindex="-1" role="dialog" aria-labelledby="pesquisaPacienteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pesquisaPacienteModalLabel">Pesquisa de Paciente</h5>
                <button type="button" class="close btn btn-light" data-dismiss="modal" aria-label="Fechar" style="width: 20%;" id="fechar_paciente_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group alinharesquerda-padding10">
                        <label for="cpfPesquisa">CPF:</label>
                        <input type="text" class="form-control" id="cpfPesquisa" placeholder="Digite o CPF" maxlength="11">
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="pesquisarPaciente(event)">Pesquisar</button>
                </form>
                <div id="pacienteNaoEncontrado"></div>
                <div id="resultadoPesquisa" class="ocultar">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th id="resp_paciente">Nome do Responsável</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaResultados">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>