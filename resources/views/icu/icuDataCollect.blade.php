@extends('layouts.icuMaster')



@section('content')

@if(isset($insertResult) && $insertResult == "Sucesso")
<div class="container" style="margin-top: 70px">
    <div class="col-sm-8">
        <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Dados Inseridos com {{ $insertResult }}!</strong>
        </div>
    </div>
</div>
@elseif(isset($insertResult) && $insertResult !== "Sucesso")
<div class="container" style="margin-top: 70px">    
    <div class="col-sm-8">
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ $insertResult }} </strong><br>Faças as correções necessárias e clique em salvar novamente!
        </div>
    </div>
</div>


@endif

<div class='container' style="margin-top: 70px">
    <div class='row'>        
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><strong><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Coleta de Dados Uti Adulto</strong></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/icuInsertData">
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="uppExposed">Número de Pacientes Expostos ao Risco de UPP: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="uppExposed" name="uppExposed" autofocus="true" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->uppExposed)){{ $request->uppExposed }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="uppCase">Número de Casos de UPP: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="uppCase" name="uppCase" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->uppCase)){{ $request->uppCase }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="pvCatheter">Número de Pacientes com Cateter Venoso Periférico: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="pvCatheter" name="pvCatheter" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->pvCatheter)){{ $request->pvCatheter }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="phlebitisCase">Número de Casos de Flebite: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="phlebitisCase" name="phlebitisCase" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->phlebitisCase)){{ $request->phlebitisCase }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="nasogastricTube">Número de Pacientes com Sonda NE: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="nasogastricTube" name="nasogastricTube" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->nasogastricTube)){{ $request->nasogastricTube }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="nasogastricTubeLost">Número de Perdas de Sonda NE: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="nasogastricTubeLost" name="nasogastricTubeLost" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->nasogastricTubeLost)){{ $request->nasogastricTubeLost }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="falls">Número de Quedas no Período: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="falls" name="falls" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->falls)){{ $request->falls }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="extubatedPatient">Número de Pacientes Extubados Acidentalmente: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="extubatedPatient" name="extubatedPatient" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->extubatedPatient)){{ $request->extubatedPatient }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="intubatedPatient">Número de Paciente Intubado Dia: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="intubatedPatient" name="intubatedPatient" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->intubatedPatient)){{ $request->intubatedPatient }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="icuReentry">Número de Reingresso na UTI Adulto: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="icuReentry" name="icuReentry" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->icuReentry)){{ $request->icuReentry }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="deaths">Número de Óbitos em Idosos &#8805 65 Anos: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="deaths" name="deaths" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->deaths)){{ $request->deaths }}@else{{""}}@endif'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-7" for="bloquedBed">Leitos Bloqueados: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control text-center" id="bloquedBed" name="bloquedBed" required value='@if(isset($insertResult) && $insertResult !== "Sucesso" && isset($request->bloquedBed)){{ $request->bloquedBed }}@else{{""}}@endif'>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">Salvar</button>
                                <a type="button" class="btn btn-success" href="/icuTable" style="margin-left: 15px;">Ver Tabela</a>                                
                                <a type="button" class="btn btn-success" href="/icuMain" style="margin-left: 15px;">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>            
            </div>
        </div>    
    </div>
</div>
@endsection
