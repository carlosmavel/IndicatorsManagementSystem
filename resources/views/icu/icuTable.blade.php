@extends('layouts.icuMaster')



@section('content')

<div class='container-fluid' style="margin-top: 70px">    

    <button class="btn btn-success" style="margin-bottom: 10px; margin-left: 10px;" data-toggle="collapse" data-target="#filtro">Filtros <i class="fa fa-arrows-v" aria-hidden="true"></i></button>

    <div id="filtro" class="collapse">
        <div class='row' style="margin: 15px">        
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Selecione o Filtro Desejado</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/icuTableFilter">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="monthFilter">Mês e Ano:</label>
                                <div class="col-sm-8">
                                    <input type="month" class="form-control" id="monthFilter" name="monthFilter">
                                </div>
                            </div>                            
                            <hr>
                            <div class="form-group">
                                <div class="col-lg-2 col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">Enviar</button>

                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class='row'>        
        <div class="col-lg-12 col-md-12 col-sm-12">            
            <div class="panel panel-success">
                <div class="panel-heading text-center" style="font-size: 16px;"><strong><i class="fa fa-table" aria-hidden="true"></i> Tabela de Coleta de Dados da UTI Adulto</strong></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead >
                                <tr class="bg-success">
                                    <th class="text-center" style="vertical-align: middle">Data</th>
                                    <th class="text-center" style="vertical-align: middle">Paciente Exposto UPP</th>
                                    <th class="text-center" style="vertical-align: middle">Casos UPP</th>
                                    <th class="text-center" style="vertical-align: middle">Pacientes c CVP</th>
                                    <th class="text-center" style="vertical-align: middle">Casos Flebite</th>
                                    <th class="text-center" style="vertical-align: middle">Pacientes c Sonda NE</th>
                                    <th class="text-center" style="vertical-align: middle">Perda de Sonda NE</th>
                                    <th class="text-center" style="vertical-align: middle">Quedas</th>
                                    <th class="text-center" style="vertical-align: middle">Pacientes Extubados Acidentalmente</th>
                                    <th class="text-center" style="vertical-align: middle">Paciente Intubado/Dia</th>
                                    <th class="text-center" style="vertical-align: middle">Reingresso UTI</th>
                                    <th class="text-center" style="vertical-align: middle">Óbitos &#8805 65 Anos</th>
                                    <th class="text-center" style="vertical-align: middle">Leitos Bloqueados</th>
                                    <th class="text-center" style="vertical-align: middle">Alterar</th>
                                    <th class="text-center" style="vertical-align: middle">Excluir</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 13px; font-family: arial; font-weight: bold;">
                                @if(isset($results))
                                @forelse($results as $result)
                                <tr class="text-center">
                                    <td style="vertical-align: middle;">{{ $result->date }}</td>
                                    <td style="vertical-align: middle;">{{ $result->pressure_ulcer_exposed}}</td>
                                    <td style="vertical-align: middle;">{{ $result->pressure_ulcer_case}}</td>
                                    <td style="vertical-align: middle;">{{ $result->patient_pv_catheter}}</td>
                                    <td style="vertical-align: middle;">{{ $result->phlebitis_case}}</td>
                                    <td style="vertical-align: middle;">{{ $result->nasogastric_tube}}</td>
                                    <td style="vertical-align: middle;">{{ $result->nasogastric_tube_lost}}</td>
                                    <td style="vertical-align: middle;">{{ $result->falls_number}}</td>
                                    <td style="vertical-align: middle;">{{ $result->extubated_patient}}</td>
                                    <td style="vertical-align: middle;">{{ $result->intubated_patient}}</td>
                                    <td style="vertical-align: middle;">{{ $result->icu_reentry}}</td>
                                    <td style="vertical-align: middle;">{{ $result->death_number}}</td>
                                    <td style="vertical-align: middle;">{{ $result->bloqued_bed}}</td>                                            
                                    <td style="vertical-align: middle;"><a href="/icuEdit?id={{ $result->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                    <td style="vertical-align: middle;"><a href="/icuDelete?id={{ $result->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="15"><strong>Nenhuma informação encontrada</strong></td>
                                </tr>
                                @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(session('status'))
                <div class="alert alert-success">
                    <p class="text-center"><strong>{{ session('status') }}</strong></p>
                </div>
                @endif
                
            </div>
            <a href="/icuDataCollect" class="btn btn-success" style="margin-left: 50%; margin-bottom: 20px;">Inserir Novos Dados</a>
        </div>    
    </div>
</div>
</div>
@endsection

