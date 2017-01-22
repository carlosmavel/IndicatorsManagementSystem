@extends('layouts.nicuMaster')

@section('content')

@if(isset($editResults) && $editResults == "Sucesso")
<div class="container" style="margin-top: 70px">
    <div class="col-sm-4">
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Dados Inseridos com {{ $editResults }}!</strong>
        </div>
    </div>
</div>
@elseif(isset($editResults) && $editResults !== "Sucesso")
<div class="container" style="margin-top: 70px">    
    <div class="col-sm-6">
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ $editResults }} </strong><br>Faças as correções necessárias e clique em salvar novamente!
        </div>
    </div>
</div>
@endif

@if(isset($results))
@forelse($results as $result)
<div class='container' style="margin-top: 70px">
    <div class='row'>        
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><strong><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alteração Coleta de Dados Uti Neonatal</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="?id={{ $result->id }}">
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="uppExposed">Número de Pacientes Expostos ao Risco de UPP: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="uppExposed" name="uppExposed" required value='@if(isset($result->pressure_ulcer_exposed)){{ $result->pressure_ulcer_exposed }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="uppCase">Número de Casos de UPP: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="uppCase" name="uppCase" required value='@if(isset($result->pressure_ulcer_case)){{ $result->pressure_ulcer_case }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="pvCatheter">Número de Pacientes com Cateter Venoso Periférico: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="pvCatheter" name="pvCatheter" required value='@if(isset($result->patient_pv_catheter)){{ $result->patient_pv_catheter }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="phlebitisCase">Número de Casos de Flebite: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="phlebitisCase" name="phlebitisCase" required value='@if(isset($result->phlebitis_case)){{ $result->phlebitis_case }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="nasogastricTube">Número de Pacientes com Sonda NG: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="nasogastricTube" name="nasogastricTube" required value='@if(isset($result->nasogastric_tube)){{ $result->nasogastric_tube }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="nasogastricTubeLost">Número de Perdas de Sonda NG: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="nasogastricTubeLost" name="nasogastricTubeLost" required value='@if(isset($result->nasogastric_tube_lost)){{ $result->nasogastric_tube_lost }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="falls">Número de Quedas no Período: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="falls" name="falls" required value='@if(isset($result->falls_number)){{ $result->falls_number }}@endif'>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="deathsLess1500">Número de Óbitos RN < 1500gr</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="deathsLess1500" name="deathsLess1500" required value='@if(isset($result->deaths_less_1500)){{ $result->deaths_less_1500 }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="dischargesLess1500">Número de Saídas RN < 1500gr</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="dischargesLess1500" name="dischargesLess1500" required value='@if(isset($result->discharges_less_1500)){{ $result->discharges_less_1500 }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="deathsBetween1500And2500">Número de Óbitos RN &#8805 1500gr e &#60 2500gr</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="deathsBetween1500And2500" name="deathsBetween1500And2500" required value='@if(isset($result->deaths_between_1500_2500)){{ $result->deaths_between_1500_2500 }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="deathsHigher2500">Número de Óbitos RN &#8805 2500gr</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="deathsHigher2500" name="deathsHigher2500" required value='@if(isset($result->deaths_higher_2500)){{ $result->deaths_higher_2500 }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="dischargesBetween1500And2500">Número de Saídas RN &#8805 1500gr e &#60 2500gr</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="dischargesBetween1500And2500" name="dischargesBetween1500And2500" required value='@if(isset($result->discharges_between_1500_2500)){{ $result->discharges_between_1500_2500 }}@else{{""}}@endif'>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="extubatedPatient">Número de Pacientes Extubados Acidentalmente: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="extubatedPatient" name="extubatedPatient" required value='@if(isset($result->extubated_patient)){{ $result->extubated_patient }}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="intubatedPatient">Número de Paciente Intubado Dia: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="intubatedPatient" name="intubatedPatient" required value='@if(isset($result->intubated_patient)){{ $result->intubated_patient }}@endif'>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="bloquedBed">Leitos Bloqueados: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="bloquedBed" name="bloquedBed" required value='@if(isset($result->bloqued_bed)){{ $result->bloqued_bed }}@endif'>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Salvar Alteração</button>
                                <a type="button" class="btn btn-success" href="/nicuTable" style="margin-left: 15px;">Ver Tabela</a>                                
                                <a type="button" class="btn btn-success" href="/nicuMain" style="margin-left: 15px;">Voltar</a>
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
