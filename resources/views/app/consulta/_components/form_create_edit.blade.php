<div class="container">
    <div class="row">
        <!-- Lado Esquerdo - Pesquisa -->
        <div class="container" style="width: 30%;">
            <form>
                <div class="form-group" style="padding: 8px;">
                    <label for="pacienteSelect">Selecione um Paciente:</label>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#pesquisaPacienteModal">
                        Pesquisar Paciente
                    </button>
                </div>
        
                <div class="form-group ocultar" style="padding: 8px;" id="modalPesquisaMedico">
                    <label for="medicoSelect">Selecione um Médico:</label>
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#pesquisaMedicoModal">
                        Pesquisar Médico
                    </button>
                </div>
        
                <div class="form-group ocultar" style="padding: 8px;" id="dt_consulta">
                    <label for="dataConsulta">Data da Consulta:</label>
                    <input type="date" class="form-control" id="dataAgendamento" name="data_agendamento" min="{{ date('Y-m-d') }}">
                </div>
        
                <div class="form-group ocultar" style="padding: 8px;" id="hr_consulta">
                    <label for="horaConsulta">Hora da Consulta:</label>
                    <input type="time" class="form-control" id="horaConsulta" name="hora_consulta" step="1800">
                </div>
            </form>
        </div>

        <!-- Lado Direito - Formulário -->
        <div class="col-md-6">
            <div class="formulario">
                <h3>Consulta</h3>
                <form method="post" action="{{ route('consulta.store', ['formsalvar'=>1])}}">
                    @csrf
                    <input type="hidden" class="form-control" id="data_hora_consulta" name="data_hora_consulta">
                    <input type="hidden" class="form-control" id="formsalvar" name="formsalvar">
                    <div class="form-group alinharesquerda-padding8">
                        <label for="paciente">Paciente:</label>
                        <input type="hidden" class="form-control" id="paciente_id" name="paciente_id">
                        <input type="text" style="text-align: center" class="form-control" id="paciente" readonly>
                    </div>
                    <div class="form-group ocultar alinharesquerda-padding8" id="inputMedicoForm">
                        <label for="medico">Médico:</label>
                        <input type="hidden" class="form-control" id="medico_id" name="medico_id">
                        <input type="text" style="text-align: center" class="form-control" id="medico" readonly>
                    </div>
                    <div class="form-group ocultar alinharesquerda-padding8" id="inputDataAgendamentoForm">
                        <label for="data_agendamento">Data consulta:</label>
                        <input type="text" style="text-align: center" class="form-control" id="data_agendamento" name="data_agendamento" readonly>
                    </div>
                    <div class="form-group ocultar alinharesquerda-padding8" id="inputHoraAgendamentoForm">
                        <label for="hora_agendamento">hora consulta:</label>
                        <input type="text" style="text-align: center" class="form-control" id="hora_agendamento" name="hora_agendamento" readonly>
                    </div>
                    <button type="submit" class="btn btn-success" id="salvar_form_consulta" disabled>Salvar</button>
                </form>
            </div>
        </div>
    </div>
    @include('app.consulta.modals.medico_modal')
    @include('app.consulta.modals.paciente_modal')
</div>
<script>
    const fusoHorarioBrasil = 'America/Sao_Paulo';
    const dataHoraBrasil = new Date().toLocaleString('en-US', { timeZone: fusoHorarioBrasil });
    $('#data_hora_consulta').val(dataHoraBrasil);

    /**
     * Função para pesquisar um paciente usando AJAX.
     * @function
     * @param {Evento} event - O evento que aciona a função.
     * @returns {void}
     */
    function pesquisarPaciente(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route("consulta.store") }}',
            data: {
                _token: '{{ csrf_token() }}',
                cpf: $('#cpfPesquisa').val()
            },
            success: function (data) {
                if(data.length < 1){
                    $('#pacienteNaoEncontrado').html('Paciente não encontrado!');
                    $('#resultadoPesquisa').addClass('ocultar');
                }else{
                    $('#pacienteNaoEncontrado').html('');
                }
                $('#tabelaResultados').empty();

                // Adicionar os resultados à tabela
                $.each(data, function(index, paciente) {
                    var newRow = $('<tr>');
                    newRow.append('<td>' + paciente.id + '</td>');
                    newRow.append('<td>' + paciente.nome + '</td>');
                    if(paciente.cpf >= 1){
                        newRow.append('<td>' + paciente.cpf + '</td>');
                        newRow.append('<td><a href="#" onclick="selecionaPaciente('+paciente.id+')">Selecionar</a></td>');
                        $('#resp_paciente').hide();
                    }else{
                        $('#resp_paciente').show();
                        newRow.append('<td>' + paciente.cpf_responsavel + '</td>');
                        newRow.append('<td>' + paciente.nome_responsavel + '</td>');
                        newRow.append('<td><a href="#" onclick="selecionaPaciente('+paciente.id+')">Selecionar</a></td>');
                    }
                    $('#tabelaResultados').append(newRow);
                    $('#resultadoPesquisa').removeClass('ocultar');
                });
                }
        });
    }

    /**
     * Selecionar um paciente.
     * @function
     * @param {number} id - O ID do paciente selecionado.
     * @returns {void}
     */
    function selecionaPaciente(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("consulta.store") }}',
            data: {
                _token: '{{ csrf_token() }}',
                paciente: id
            },
            success: function (data) {
                $('#paciente').val(data.nome+ ' - ' + (data.cpf ? data.cpf : data.cpf_responsavel));
                $('#paciente_id').val(data.id);
                if(!data.cpf){
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("consulta.store") }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            especialidade_id: id
                        },
                        success: function (data) {
                            $('select[name="especialidade_id"]').val(data);
                        }
                    }); 
                    $('select[name="especialidade_id"]').prop('disabled', true)
                }
                else{
                    $('select[name="especialidade_id"]').prop('disabled', false)
                }
                $('#fechar_paciente_modal').click();
                $('#modalPesquisaMedico').removeClass('ocultar');
                $('#inputMedicoForm').removeClass('ocultar');
            }
        }); 
    };

    /**
     * Pesquisar um médico usando AJAX.
     * @function
     * @param {Evento} event - O evento que aciona a função.
     * @returns {void}
     */
    function pesquisarMedico(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route("consulta.store") }}',
            data: {
                _token: '{{ csrf_token() }}',
                crm: $('#crmPesquisa').val(),
                especialidade: $('select[name="especialidade_id"]').val()
            },
            success: function (data) {
                console.log(data)
                if(data.length < 1){
                    $('#medicoNaoEncontrado').html('Médico não encontrado!');
                    $('#resultadoPesquisa_medico').addClass('ocultar');
                }else{
                    $('#medicoNaoEncontrado').html('');
                }
                $('#tabelaResultados_medico').empty();

                // Adicionar os resultados à tabela
                $.each(data, function(index, medico) {
                    var newRow = $('<tr>');
                    newRow.append('<td>' + medico.id + '</td>');
                    newRow.append('<td>' + medico.nome + '</td>');
                    newRow.append('<td>' + medico.crm + '</td>');
                    newRow.append('<td>' + medico.nome_especialidade + '</td>');
                    newRow.append('<td><a href="#" onclick="selecionaMedico('+medico.id+')">Selecionar</a></td>');
                    $('#tabelaResultados_medico').append(newRow);
                    $('#resultadoPesquisa_medico').removeClass('ocultar');
                });
                }
        });
    }

    /**
     * Selecionar um médico.
     * @function
     * @param {number} id - O ID do médico selecionado.
     * @returns {void}
     */
    function selecionaMedico(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("consulta.store") }}',
            data: {
                _token: '{{ csrf_token() }}',
                medico: id
            },
            success: function (data) {
                $('#medico').val(data.nome+ ' - ' + data.crm);
                $('#medico_id').val(data.id);
                $('#fechar_medico_modal').click();
                $('#modalPesquisaMedico').removeClass('ocultar');
                $('#inputMedicoForm').removeClass('ocultar');
                $('#dt_consulta').removeClass('ocultar');
                $('#inputDataAgendamentoForm').removeClass('ocultar');
            }
        }); 
    };

    $('#dataAgendamento').on('change', function(){
        var dataFormatoPadrao = $(this).val();
        var dataFormatoBrasileiro = formatarDataBrasileira(dataFormatoPadrao);
        $('#data_agendamento').val(dataFormatoBrasileiro); 
        $('#inputHoraAgendamentoForm').removeClass('ocultar'); 
        $('#hr_consulta').removeClass('ocultar');
    });

    $('#horaConsulta').on('change', function(){
        $('#hora_agendamento').val($(this).val());
        $('#salvar_form_consulta').prop('disabled', false);
    })

    /**
     * Formata uma data do formato padrão para o formato brasileiro.
     * @function
     * @param {string} dataFormatoPadrao - A data no formato padrão.
     * @returns {string} A data no formato brasileiro.
     */
    function formatarDataBrasileira(dataFormatoPadrao) {
        var partesData = dataFormatoPadrao.split("-");
        return partesData[2] + '/' + partesData[1] + '/' + partesData[0];
    }

</script>