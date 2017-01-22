@extends('layouts.paMaster')


@section('content')
@if(isset($processResult) && $processResult == "Sucesso")
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="successModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-success">                    
                    <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                    <h4 class="modal-title"><strong>Internação inserida com {{ $processResult }}!</strong></h4>
                </div>
                <div class="modal-body">
                    <p class='text-center'>Escolha uma opção abaixo.</p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-success" href="/paTable"><i class="fa fa-table" aria-hidden="true"></i> Ver Tabela</a>
                    <a href="/paDataCollect" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Inserir Nova Internação</a>
                    <a type="button" class="btn btn-success" href="/home"><i class="fa fa-home" aria-hidden="true" title="Página Inicial"></i> Página Inicial</a>
                </div>
            </div>

        </div>
    </div>
</div>
@elseif(isset($processResult) && $processResult !== "Sucesso")
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="errorModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-danger">                    
                    <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                    <h4 class="modal-title"><strong>{{ $processResult }} </strong><br>Faças as correções necessárias e clique em salvar novamente!</h4>
                </div>
                <div class="modal-body">
                    <p class='text-center'>Clique no botão corrigir para editar as informações inseridas.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeModal">Corrigir</button>                    
                </div>
            </div>

        </div>
    </div>
</div>
@endif
@if(isset($processResult) && $processResult == "Sucesso")
<div class="container">
    <div class="col-sm-4">
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Internação inserida com {{ $processResult }}!</strong>
        </div>
    </div>
</div>
@elseif(isset($processResult) && $processResult !== "Sucesso")
<div class="container">    
    <div class="col-sm-6">
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ $processResult }} </strong><br>Faças as correções necessárias e clique em salvar novamente!
        </div>
    </div>
</div>


@endif

<div class='container'>
    <div class='row'>        
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><strong><i class="fa fa-pencil-square-o" aria-hidden="true"></i> teste Procedentes do Pronto Atendimento</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/testInsert">
                        <div class="form-group{{ $errors->has('patientName') ? ' has-error' : '' }}">
                            
                            <label class="control-label col-sm-3" for="patientName">Nome Paciente:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="patientName" autofocus="true" placeholder="Nome Completo do Paciente" value='@if(isset($processResult) && $processResult !== "Sucesso" && isset($request->patientName)){{ $request->patientName }}@else{{""}}@endif'>
                                @if ($errors->has('patientName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('patientName') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="diagnostic">CID-10:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="diagnostic" placeholder="Exemplo: R10" value='@if(isset($processResult) && $processResult !== "Sucesso" && isset($request->diagnostic)){{ $request->diagnostic }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="emergencyDoctor">Médico PA:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="emergencyDoctor" id="emergencyDoctor" placeholder="Nome Completo - Não Acrescentar Dr. ou Dra." value='@if(isset($processResult) && $processResult !== "Sucesso" && isset($request->emergencyDoctor)){{ $request->emergencyDoctor }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="removal">Remoção:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="removal" value="Sim" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->removal) && $request->removal == "Sim"){{ 'checked' }} @else {{ "" }}@endif>Sim</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="removal" value="Não" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->removal) && $request->removal == "Não"){{ 'checked' }} @else {{ "" }}@endif>Não</label>
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="serviceNumber">Número Atendimento:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" name="serviceNumber" value='@if(isset($processResult) && $processResult !== "Sucesso" && isset($request->serviceNumber)){{ $request->serviceNumber }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="place">Local:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="place" value="Hospital Unimed" onclick="teste" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->place) && $request->place == "Hospital Unimed"){{ 'checked' }} @else {{ "" }}@endif>Hospital Unimed</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="place" value="Santa Casa" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->place) && $request->place == "Santa Casa"){{ 'checked' }} @else {{ "" }}@endif>Santa Casa</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input data-toggle="collapse" data-target="#otherPlace" type="radio" name="place" Value="Outros" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->place) && $request->place == "Outros"){{ 'checked' }} @else {{ "" }}@endif>Outros</label>
                                </div>  
                            </div>
                        </div>

                        @if(isset($request->otherPlace) && $request->otherPlace == 'Outros')
                        <div class="form-group collapse in" id="otherPlace">
                            <label class="control-label col-sm-3" for="otherPlace">Local Internação:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="otherPlace" value="@if(isset($processResult) && $processResult !== 'Sucesso' && isset($request->place) && $request->place == 'Outros'){{ $request->otherPlace }}@else{{ "" }}@endif">
                            </div>
                        </div>
                        @else 
                        <div class="form-group collapse" id="outroLocal">
                            <label class="control-label col-sm-3" for="otherPlace">Local:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="otherPlace" value="@if(isset($processResult) && $processResult !== 'Sucesso' && isset($request->optradiolocal) && $request->optradiolocal == 'Outros'){{ $request->outroLocal }}@else{{ "" }}@endif">
                            </div>
                        </div>
                        @endif    


                        <div class="form-group">
                            <label class="control-label col-sm-3" for="bed">Leito:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" name="bed" value='@if(isset($processResult) && $processResult !== "Sucesso" && isset($request->bed)){{ $request->bed }}@endif'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="emergency_level">Classificação:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="emergency_level" value="Pouco Urgente" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->emergency_level) && $request->emergency_level == "Pouco Urgente"){{ 'checked' }} @else {{ "" }}@endif>Pouco Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="emergency_level" value="Urgente" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->emergency_level) && $request->emergency_level == "Urgente"){{ 'checked' }} @else {{ "" }}@endif>Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="emergency_level" value="Muito Urgente" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->emergency_level) && $request->emergency_level == "Muito Urgente"){{ 'checked' }} @else {{ "" }}@endif>Muito Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="emergency_level" value="Emergência" @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->emergency_level) && $request->emergency_level == "Emergência"){{ 'checked' }} @else {{ "" }}@endif>Emergência</label>
                                </div>                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="especialityDoctor">Médico Especialista:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="especialityDoctor" id="especialityDoctor" value='@if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especialityDoctor)){{ $request->especialityDoctor }}@endif'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="especiality">Especialidade:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="especiality">
                                    <option value='selecione'>Selecione:</option>
                                    <option></option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cirurgia Geral"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Geral</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Clínica Médica"){{ "selected" }} @else {{ "" }} @endif>Clínica Médica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Hospitalista"){{ "selected" }} @else {{ "" }} @endif>Hospitalista</option>                                    
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cardiologia"){{ "selected" }} @else {{ "" }} @endif>Cardiologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Geriatria"){{ "selected" }} @else {{ "" }} @endif>Geriatria</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Pediatria"){{ "selected" }} @else {{ "" }} @endif>Pediatria</option>
                                    <option></option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Acupuntura"){{ "selected" }} @else {{ "" }} @endif>Acupuntura</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Alergia e Imunologia"){{ "selected" }} @else {{ "" }} @endif>Alergia e Imunologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Anatomia Patológica"){{ "selected" }} @else {{ "" }} @endif>Anatomia Patológica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Anestesiologia"){{ "selected" }} @else {{ "" }} @endif>Anestesiologia</option>                                                                       
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Angiologia / Cirurgia Vascular"){{ "selected" }} @else {{ "" }} @endif>Angiologia / Cirurgia Vascular</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Bucomaxilofacial"){{ "selected" }} @else {{ "" }} @endif>Bucomaxilofacial</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cancerologia Clínica"){{ "selected" }} @else {{ "" }} @endif>Cancerologia Clínica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cancerologia Cirúrgica"){{ "selected" }} @else {{ "" }} @endif>Cancerologia Cirúrgica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cardiologia"){{ "selected" }} @else {{ "" }} @endif>Cardiologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cirurgia Cardiovascular"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Cardiovascular</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cirurgia Geral"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Geral</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cirurgia Pediátrica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Pediátrica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cirurgia Plástica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Plástica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Cirurgia Torácica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Torácica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Clínica Médica"){{ "selected" }} @else {{ "" }} @endif>Clínica Médica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Coloproctologia"){{ "selected" }} @else {{ "" }} @endif>Coloproctologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Dermatologia"){{ "selected" }} @else {{ "" }} @endif>Dermatologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Endocrinologia"){{ "selected" }} @else {{ "" }} @endif>Endocrinologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Gastroenterologia"){{ "selected" }} @else {{ "" }} @endif>Gastroenterologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Geriatria"){{ "selected" }} @else {{ "" }} @endif>Geriatria</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Genética Médica"){{ "selected" }} @else {{ "" }} @endif>Genética Médica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Ginecologia e Obstetrícia"){{ "selected" }} @else {{ "" }} @endif>Ginecologia e Obstetrícia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Hematologia"){{ "selected" }} @else {{ "" }} @endif>Hematologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Homeopatia"){{ "selected" }} @else {{ "" }} @endif>Homeopatia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Hospitalista"){{ "selected" }} @else {{ "" }} @endif>Hospitalista</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Infectologia"){{ "selected" }} @else {{ "" }} @endif>Infectologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Mastologia"){{ "selected" }} @else {{ "" }} @endif>Mastologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Medicina Intensiva"){{ "selected" }} @else {{ "" }} @endif>Medicina Intensiva</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Nefrologia"){{ "selected" }} @else {{ "" }} @endif>Nefrologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Neurologia"){{ "selected" }} @else {{ "" }} @endif>Neurologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Neurocirurgia"){{ "selected" }} @else {{ "" }} @endif>Neurocirurgia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Nutrologia"){{ "selected" }} @else {{ "" }} @endif>Nutrologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Oftalmologia"){{ "selected" }} @else {{ "" }} @endif>Oftalmologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Ortopedia e Traumologia"){{ "selected" }} @else {{ "" }} @endif>Ortopedia e Traumologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Otorrinolaringologia"){{ "selected" }} @else {{ "" }} @endif>Otorrinolaringologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Patologia Clínica"){{ "selected" }} @else {{ "" }} @endif>Patologia Clínica</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Pediatria"){{ "selected" }} @else {{ "" }} @endif>Pediatria</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Pneumologia"){{ "selected" }} @else {{ "" }} @endif>Pneumologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Psiquiatria"){{ "selected" }} @else {{ "" }} @endif>Psiquiatria</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Radiologia"){{ "selected" }} @else {{ "" }} @endif>Radiologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Radioterapia"){{ "selected" }} @else {{ "" }} @endif>Radioterapia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Reumatologia"){{ "selected" }} @else {{ "" }} @endif>Reumatologia</option>
                                    <option @if(isset($processResult) && $processResult !== "Sucesso" && isset($request->especiality) && $request->especiality == "Urologia"){{ "selected" }} @else {{ "" }} @endif>Urologia</option>

                                </select>
                            </div>
                        </div>  

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Salvar</button>
                                <a type="button" class="btn btn-success" href="/paTable" style="margin-left: 15px;">Ver Tabela</a>                                
                                <a type="button" class="btn btn-success" href="/home" style="margin-left: 15px;">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>    
    </div>
</div>
@if(isset($processResult) && $processResult == "Sucesso")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Show the Modal on load
    $("#successModal").modal("show");
    
    // Hide the Modal
    $("#closeModal").click(function(){
        $("#successModal").modal("hide");
    });
});
</script>
@elseif(isset($processResult) && $processResult !== "Sucesso")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Show the Modal on load
    $("#errorModal").modal("show");
    
    // Hide the Modal
    $("#closeModal").click(function(){
        $("#errorModal").modal("hide");
    });
});
</script>
@endif

@endsection
