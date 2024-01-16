<!-- Modal de Pesquisa de Médico -->
<div class="modal fade" id="pesquisaMedicoModal" tabindex="-1" role="dialog" aria-labelledby="pesquisaMedicoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pesquisaMedicoModalLabel">Pesquisa de Médico</h5>
                <button type="button" class="close btn btn-light" data-dismiss="modal" aria-label="Fechar" style="width: 20%;" id="fechar_medico_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group alinharesquerda-padding10">
                        <label for="crmPesquisa">CRM:</label>
                        <input type="text" class="form-control" id="crmPesquisa" placeholder="Digite o CRM">
                    </div>
                    <div class="form-group alinharesquerda-padding10">
                        <label for="especialidadePesquisa">Especialidade:</label>
                        <select name="especialidade_id" class="form-control">
                            <option value="" style="text-align: center" disabled selected>-- Selecione a Especialidade --</option>
                            @foreach ($especialidades as $especialidade)
                               <option value="{{ $especialidade->id }}" {{old('especialidade_id') == $especialidade->id  ? 'selected' : ''}}>{{ $especialidade->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"  onclick="pesquisarMedico(event)">Pesquisar</button>
                </form>
                <div id="medicoNaoEncontrado"></div>
                <div id="resultadoPesquisa_medico" class="ocultar">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CRM</th>
                                <th>Especialidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaResultados_medico">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>