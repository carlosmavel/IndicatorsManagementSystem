@extends('layouts.paMaster')

@section('content')

@if(isset($resultadoProcessar))
    <div class="container">
    <div class="col-sm-4">
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Internação inserida com {{ $resultadoProcessar }}!</strong>
        </div>
    </div>
</div>
@endif

<div class='container'>
    <div class='row'>        
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"> Internações Procedentes do Pronto Atendimento</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="?internacoes">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="nomePaciente">Nome Paciente:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="nomePaciente" placeholder="Nome Completo do Paciente" value='@if(isset($request->nomePaciente)){{ $request->nomePaciente }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="diagnostico">Diagnóstico:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="diagnostico" value='@if(isset($request->diagnostico)){{ $request->diagnostico }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="medicoPA">Médico PA:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="medicoPA" value='@if(isset($request->medicoPA)){{ $request->medicoPA }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="remocao">Remoção:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradioremocao" value="Sim" @if(isset($request->optradioremocao) && $request->optradioremocao == "Sim"){{ 'checked' }} @else {{ "" }}@endif>Sim</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradioremocao" value="Não" @if(isset($request->optradioremocao) && $request->optradioremocao == "Não"){{ 'checked' }} @else {{ "" }}@endif>Não</label>
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="atendimento">Número Atendimento:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" name="numeroAtendimento" value='@if(isset($request->numeroAtendimento)){{ $request->numeroAtendimento }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="optradiolocal">Local:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradiolocal" value="Hospital Unimed" @if(isset($request->optradiolocal) && $request->optradiolocal == "Hospital Unimed"){{ 'checked' }} @else {{ "" }}@endif>Hospital Unimed</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradiolocal" value="Santa Casa" @if(isset($request->optradiolocal) && $request->optradiolocal == "Santa Casa"){{ 'checked' }} @else {{ "" }}@endif>Santa Casa</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input data-toggle="collapse" data-target="#outroLocal" type="radio" name="optradiolocal" Value="Outros" @if(isset($request->optradiolocal) && $request->optradiolocal == "Outros"){{ 'checked' }} @else {{ "" }}@endif>Outros</label>
                                </div>  
                            </div>
                        </div>
                        @if(isset($request->optradiolocal) && $request->optradiolocal == 'Outros')
                        <div class="form-group collapse in" id="outroLocal">
                            <label class="control-label col-sm-3" for="outroLocal">Local:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="outroLocal" value="@if(isset($request->optradiolocal) && $request->optradiolocal == 'Outros'){{ $request->outroLocal }} @else {{ "" }}@endif">
                            </div>
                        </div>
                        @else 
                        <div class="form-group collapse" id="outroLocal">
                            <label class="control-label col-sm-3" for="outroLocal">Local:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="outroLocal" value="@if(isset($request->optradiolocal) && $request->optradiolocal == 'Outros'){{ $request->outroLocal }} @else {{ "" }}@endif">
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="leito">Leito:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" name="leito" value='@if(isset($request->leito)){{ $request->leito }}@endif'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="optRadioClassificacao">Classificação:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Pouco Urgente" @if(isset($request->optRadioClassificacao) && $request->optRadioClassificacao == "Pouco Urgente"){{ 'checked' }} @else {{ "" }}@endif>Pouco Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Urgente" @if(isset($request->optRadioClassificacao) && $request->optRadioClassificacao == "Urgente"){{ 'checked' }} @else {{ "" }}@endif>Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Muito Urgente" @if(isset($request->optRadioClassificacao) && $request->optRadioClassificacao == "Muito Urgente"){{ 'checked' }} @else {{ "" }}@endif>Muito Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Emergência" @if(isset($request->optRadioClassificacao) && $request->optRadioClassificacao == "Emergência"){{ 'checked' }} @else {{ "" }}@endif>Emergência</label>
                                </div>                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="medicoPA">Médico Especialista:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="medicoEspecialista" value='@if(isset($request->medicoEspecialista)){{ $request->medicoEspecialista }}@endif'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="selEspecialidade">Especialidade:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="selEspecialidade">
                                    <option value='selecione'>Selecione:</option>
                                    <option></option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cirurgia Geral"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Geral</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Clínica Médica"){{ "selected" }} @else {{ "" }} @endif>Clínica Médica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Hospitalista"){{ "selected" }} @else {{ "" }} @endif>Hospitalista</option>                                    
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cardiologia"){{ "selected" }} @else {{ "" }} @endif>Cardiologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Geriatria"){{ "selected" }} @else {{ "" }} @endif>Geriatria</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Pediatria"){{ "selected" }} @else {{ "" }} @endif>Pediatria</option>
                                    <option></option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Acupuntura"){{ "selected" }} @else {{ "" }} @endif>Acupuntura</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Alergia e Imunologia"){{ "selected" }} @else {{ "" }} @endif>Alergia e Imunologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Anatomia Patológica"){{ "selected" }} @else {{ "" }} @endif>Anatomia Patológica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Anestesiologia"){{ "selected" }} @else {{ "" }} @endif>Anestesiologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Angiologia / Cirurgia Vascular"){{ "selected" }} @else {{ "" }} @endif>Angiologia / Cirurgia Vascular</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cancerologia Clínica"){{ "selected" }} @else {{ "" }} @endif>Cancerologia Clínica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cancerologia Cirúrgica"){{ "selected" }} @else {{ "" }} @endif>Cancerologia Cirúrgica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cardiologia"){{ "selected" }} @else {{ "" }} @endif>Cardiologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cirurgia Cardiovascular"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Cardiovascular</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cirurgia Geral"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Geral</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cirurgia Pediátrica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Pediátrica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cirurgia Plástica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Plástica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Cirurgia Torácica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Torácica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Clínica Médica"){{ "selected" }} @else {{ "" }} @endif>Clínica Médica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Coloproctologia"){{ "selected" }} @else {{ "" }} @endif>Coloproctologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Dermatologia"){{ "selected" }} @else {{ "" }} @endif>Dermatologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Endocrinologia"){{ "selected" }} @else {{ "" }} @endif>Endocrinologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Gastroenterologia"){{ "selected" }} @else {{ "" }} @endif>Gastroenterologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Geriatria"){{ "selected" }} @else {{ "" }} @endif>Geriatria</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Genética Médica"){{ "selected" }} @else {{ "" }} @endif>Genética Médica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Ginecologia e Obstetrícia"){{ "selected" }} @else {{ "" }} @endif>Ginecologia e Obstetrícia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Hematologia"){{ "selected" }} @else {{ "" }} @endif>Hematologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Homeopatia"){{ "selected" }} @else {{ "" }} @endif>Homeopatia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Hospitalista"){{ "selected" }} @else {{ "" }} @endif>Hospitalista</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Infectologia"){{ "selected" }} @else {{ "" }} @endif>Infectologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Mastologia"){{ "selected" }} @else {{ "" }} @endif>Mastologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Medicina Intensiva"){{ "selected" }} @else {{ "" }} @endif>Medicina Intensiva</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Nefrologia"){{ "selected" }} @else {{ "" }} @endif>Nefrologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Neurologia"){{ "selected" }} @else {{ "" }} @endif>Neurologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Neurocirurgia"){{ "selected" }} @else {{ "" }} @endif>Neurocirurgia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Nutrologia"){{ "selected" }} @else {{ "" }} @endif>Nutrologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Oftalmologia"){{ "selected" }} @else {{ "" }} @endif>Oftalmologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Ortopedia e Traumologia"){{ "selected" }} @else {{ "" }} @endif>Ortopedia e Traumologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Otorrinolaringologia"){{ "selected" }} @else {{ "" }} @endif>Otorrinolaringologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Patologia Clínica"){{ "selected" }} @else {{ "" }} @endif>Patologia Clínica</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Pediatria"){{ "selected" }} @else {{ "" }} @endif>Pediatria</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Pneumologia"){{ "selected" }} @else {{ "" }} @endif>Pneumologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Psiquiatria"){{ "selected" }} @else {{ "" }} @endif>Psiquiatria</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Radiologia"){{ "selected" }} @else {{ "" }} @endif>Radiologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Radioterapia"){{ "selected" }} @else {{ "" }} @endif>Radioterapia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Reumatologia"){{ "selected" }} @else {{ "" }} @endif>Reumatologia</option>
                                    <option @if(isset($request->selEspecialidade) && $request->selEspecialidade == "Urologia"){{ "selected" }} @else {{ "" }} @endif>Urologia</option>

                                </select>
                            </div>
                        </div>  

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default">Salvar</button>
                                <a type="button" class="btn btn-default" href="/tabelaInternacoes">Ver Tabela</a>                                
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>    
    </div>
</div>
@endsection
