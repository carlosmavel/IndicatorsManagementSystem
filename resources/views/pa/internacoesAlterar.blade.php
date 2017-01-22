@extends('layouts.paMaster')

@section('content')

@if(isset($resultadoAtualizar))
<p>{{ $resultadoAtualizar }}</p>
@endif

@if(isset($resultadoEditar))
@forelse($resultadoEditar as $resultado)

<div class='container'>
    <div class='row'>        
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"> Internações Procedentes do Pronto Atendimento</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="?id={{ $resultado->i_id }}">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="nomePaciente">Nome Paciente:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="nomePaciente" value='@if(isset($resultado->nome_paciente)){{ $resultado->nome_paciente }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="diagnostico">CID-10:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="diagnostico" value='@if(isset($resultado->diagnostico)){{ $resultado->diagnostico }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="medicoPA">Médico PA:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="medicoPA" id="medicoPA" value='@if(isset($resultado->medico_pa)){{ $resultado->medico_pa }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="remocao">Remoção:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradioremocao" value="Sim" @if(isset($resultado->remocao) && $resultado->remocao == "Sim"){{ 'checked' }} @else {{ "" }}@endif>Sim</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradioremocao" value="Não" @if(isset($resultado->remocao) && $resultado->remocao == "Não"){{ 'checked' }} @else {{ "" }}@endif>Não</label>
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="atendimento">Número Atendimento:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" name="numeroAtendimento" value='@if(isset($resultado->nr_atendimento)){{ $resultado->nr_atendimento }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="optradiolocal">Local:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradiolocal" value="Meu Hospital" @if(isset($resultado->local_internacao) && $resultado->local_internacao == "Meu Hospital"){{ 'checked' }} @else {{ "" }}@endif>Meu Hospital</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradiolocal" value="Santa Casa" @if(isset($resultado->local_internacao) && $resultado->local_internacao == "Santa Casa"){{ 'checked' }} @else {{ "" }}@endif>Santa Casa</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input data-toggle="collapse" data-target="#outroLocal" type="radio" name="optradiolocal" Value="Outros" @if(isset($resultado->local_internacao) && $resultado->local_internacao == 'Meu Hospital' || $resultado->local_internacao == 'Santa Casa'){{ "" }}@else{{ 'checked' }}@endif>Outros</label>
                                </div>  
                            </div>
                        </div>
                        
                        @if(isset($resultado->local_internacao) && $resultado->local_internacao == 'Meu Hospital' || $resultado->local_internacao == 'Santa Casa')
                        <div class="form-group collapse" id="outroLocal">
                            <label class="control-label col-sm-3" for="outroLocal">Local:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="outroLocal" value="@if(isset($resultado->local_internacao) && $resultado->local_internacao == 'Meu Hospital' || $resultado->local_internacao == 'Santa Casa'){{ "" }}@else{{ $resultado->local_internacao }}@endif">
                            </div>
                        </div>
                        @else 
                        <div class="form-group collapse in" id="outroLocal">
                            <label class="control-label col-sm-3" for="outroLocal">Local:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="outroLocal" value="@if(isset($resultado->local_internacao) && $resultado->local_internacao == 'Meu Hospital' || $resultado->local_internacao == 'Santa Casa'){{ "" }}@else{{ $resultado->local_internacao }}@endif">
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="leito">Leito:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" name="leito" value='@if(isset($resultado->Leito)){{ $resultado->Leito }}@endif'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="optRadioClassificacao">Classificação:</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Pouco Urgente" @if(isset($resultado->classificacao) && $resultado->classificacao == "Pouco Urgente"){{ 'checked' }} @else {{ "" }}@endif>Pouco Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Urgente" @if(isset($resultado->classificacao) && $resultado->classificacao == "Urgente"){{ 'checked' }} @else {{ "" }}@endif>Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Muito Urgente" @if(isset($resultado->classificacao) && $resultado->classificacao == "Muito Urgente"){{ 'checked' }} @else {{ "" }}@endif>Muito Urgente</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optRadioClassificacao" value="Emergência" @if(isset($resultado->classificacao) && $resultado->classificacao == "Emergência"){{ 'checked' }} @else {{ "" }}@endif>Emergência</label>
                                </div>                               
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="medicoPA">Médico Especialista:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="medicoEspecialista" id="medicoEspecialista" value='@if(isset($resultado->medico_especialista)){{ $resultado->medico_especialista }}@endif'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" for="selEspecialidade">Especialidade:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="selEspecialidade">
                                    <option>Selecione:</option>
                                    <option></option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cirurgia Geral"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Geral</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Clínica Médica"){{ "selected" }} @else {{ "" }} @endif>Clínica Médica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Hospitalista"){{ "selected" }} @else {{ "" }} @endif>Hospitalista</option>                                    
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cardiologia"){{ "selected" }} @else {{ "" }} @endif>Cardiologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Geriatria"){{ "selected" }} @else {{ "" }} @endif>Geriatria</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Pediatria"){{ "selected" }} @else {{ "" }} @endif>Pediatria</option>
                                    <option></option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Acupuntura"){{ "selected" }} @else {{ "" }} @endif>Acupuntura</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Alergia e Imunologia"){{ "selected" }} @else {{ "" }} @endif>Alergia e Imunologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Anatomia Patológica"){{ "selected" }} @else {{ "" }} @endif>Anatomia Patológica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Anestesiologia"){{ "selected" }} @else {{ "" }} @endif>Anestesiologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Angiologia / Cirurgia Vascular"){{ "selected" }} @else {{ "" }} @endif>Angiologia / Cirurgia Vascular</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Bucomaxilofacial"){{ "selected" }} @else {{ "" }} @endif>Bucomaxilofacial</option>                                    
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cancerologia Clínica"){{ "selected" }} @else {{ "" }} @endif>Cancerologia Clínica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cancerologia Cirúrgica"){{ "selected" }} @else {{ "" }} @endif>Cancerologia Cirúrgica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cardiologia"){{ "selected" }} @else {{ "" }} @endif>Cardiologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cirurgia Cardiovascular"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Cardiovascular</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cirurgia Geral"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Geral</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cirurgia Pediátrica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Pediátrica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cirurgia Plástica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Plástica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Cirurgia Torácica"){{ "selected" }} @else {{ "" }} @endif>Cirurgia Torácica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Clínica Médica"){{ "selected" }} @else {{ "" }} @endif>Clínica Médica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Coloproctologia"){{ "selected" }} @else {{ "" }} @endif>Coloproctologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Dermatologia"){{ "selected" }} @else {{ "" }} @endif>Dermatologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Endocrinologia"){{ "selected" }} @else {{ "" }} @endif>Endocrinologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Gastroenterologia"){{ "selected" }} @else {{ "" }} @endif>Gastroenterologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Geriatria"){{ "selected" }} @else {{ "" }} @endif>Geriatria</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Genética Médica"){{ "selected" }} @else {{ "" }} @endif>Genética Médica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Ginecologia e Obstetrícia"){{ "selected" }} @else {{ "" }} @endif>Ginecologia e Obstetrícia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Hematologia"){{ "selected" }} @else {{ "" }} @endif>Hematologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Homeopatia"){{ "selected" }} @else {{ "" }} @endif>Homeopatia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Hospitalista"){{ "selected" }} @else {{ "" }} @endif>Hospitalista</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Infectologia"){{ "selected" }} @else {{ "" }} @endif>Infectologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Mastologia"){{ "selected" }} @else {{ "" }} @endif>Mastologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Medicina Intensiva"){{ "selected" }} @else {{ "" }} @endif>Medicina Intensiva</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Nefrologia"){{ "selected" }} @else {{ "" }} @endif>Nefrologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Neurologia"){{ "selected" }} @else {{ "" }} @endif>Neurologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Neurocirurgia"){{ "selected" }} @else {{ "" }} @endif>Neurocirurgia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Nutrologia"){{ "selected" }} @else {{ "" }} @endif>Nutrologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Oftalmologia"){{ "selected" }} @else {{ "" }} @endif>Oftalmologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Ortopedia e Traumologia"){{ "selected" }} @else {{ "" }} @endif>Ortopedia e Traumologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Otorrinolaringologia"){{ "selected" }} @else {{ "" }} @endif>Otorrinolaringologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Patologia Clínica"){{ "selected" }} @else {{ "" }} @endif>Patologia Clínica</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Pediatria"){{ "selected" }} @else {{ "" }} @endif>Pediatria</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Pneumologia"){{ "selected" }} @else {{ "" }} @endif>Pneumologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Psiquiatria"){{ "selected" }} @else {{ "" }} @endif>Psiquiatria</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Radiologia"){{ "selected" }} @else {{ "" }} @endif>Radiologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Radioterapia"){{ "selected" }} @else {{ "" }} @endif>Radioterapia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Reumatologia"){{ "selected" }} @else {{ "" }} @endif>Reumatologia</option>
                                    <option @if(isset($resultado->Especialidade) && $resultado->Especialidade == "Urologia"){{ "selected" }} @else {{ "" }} @endif>Urologia</option>
                                    
                                </select>
                            </div>
                        </div>  

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Salvar</button>
                                <a type="button" class="btn btn-success" href="/paTable">Voltar</a>                                
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>    
    </div>
</div>
@empty
<p>Erro</p>
@endforelse
@endif
@endsection

