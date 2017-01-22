@extends('layouts.nicuMaster')

@section('content')

<div class='container-fluid' style="margin-top: 70px">    

    <button class="btn btn-success" style="margin-bottom: 10px; margin-left: 10px;" data-toggle="collapse" data-target="#filtro">Filtros <i class="fa fa-arrows-v" aria-hidden="true"></i></button>

    <div id="filtro" class="collapse">
        <div class='row' style="margin: 15px">        
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Selecione o Filtro Desejado</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/nicuTableFilter">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="monthFilter">Mensal:</label>
                                <div class="col-sm-8">
                                    <input type="month" class="form-control" name="monthFilter" id="monthFilter">
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
                <div class="panel-heading text-center" style="font-size: 16px;"><strong><i class="fa fa-table" aria-hidden="true"></i> Tabela de Coleta de Dados da UTI Neonatal</strong></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr class="bg-success">
                                    <th class="text-center" style="vertical-align: middle">Data</th>
                                    <th class="text-center" style="vertical-align: middle">Expostos UPP</th>
                                    <th class="text-center" style="vertical-align: middle">Casos UPP</th>
                                    <th class="text-center" style="vertical-align: middle">Cateter VP</th>
                                    <th class="text-center" style="vertical-align: middle">Casos Flebite</th>
                                    <th class="text-center" style="vertical-align: middle">Com Sonda NE</th>
                                    <th class="text-center" style="vertical-align: middle">Perda de Sonda NE</th>
                                    <th class="text-center" style="vertical-align: middle">Quedas</th>
                                    <th class="text-center" style="vertical-align: middle">Óbitos RN < 1500</th>
                                    <th class="text-center" style="vertical-align: middle">Saídas RN < 1500</th>
                                    <th class="text-center" style="vertical-align: middle">Óbitos Entre 1500 e 2500</th>
                                    <th class="text-center" style="vertical-align: middle">Óbitos &#60 2500</th>
                                    <th class="text-center" style="vertical-align: middle">Saídas Entre 1500 e 2500</th>
                                    <th class="text-center" style="vertical-align: middle">Extubados Acidentalmente</th>
                                    <th class="text-center" style="vertical-align: middle">Intubado/Dia</th>
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
                                    <td style="vertical-align: middle;">{{ $result->deaths_less_1500}}</td>
                                    <td style="vertical-align: middle;">{{ $result->discharges_less_1500}}</td>
                                    <td style="vertical-align: middle;">{{ $result->deaths_between_1500_2500}}</td>
                                    <td style="vertical-align: middle;">{{ $result->deaths_higher_2500}}</td>
                                    <td style="vertical-align: middle;">{{ $result->discharges_between_1500_2500}}</td>                                            
                                    <td style="vertical-align: middle;">{{ $result->extubated_patient}}</td>
                                    <td style="vertical-align: middle;">{{ $result->intubated_patient}}</td>
                                    <td style="vertical-align: middle;">{{ $result->bloqued_bed}}</td>                                            
                                    <td style="vertical-align: middle;"><a href="/nicuEdit?id={{ $result->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                    <td style="vertical-align: middle;"><a href="/nicuDelete?id={{ $result->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="18"><strong>Nenhuma informação encontrada</strong></td>
                                </tr>
                                @endforelse
                                @endif
                            </tbody>
                            <tfoot class="bg-success text-center">
                                @if(isset($sum))
                                <td style="vertical-align: middle"><strong>Total</strong></td>
                                @foreach($sum as $s)
                                <td style="vertical-align: middle"><strong>{{ $s[1] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[2] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[3] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[4] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[5] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[6] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[7] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[8] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[9] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[10] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[11] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[12] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[13] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[14] }}</strong></td>
                                <td style="vertical-align: middle"><strong>{{ $s[15] }}</strong></td>
                                <td style="vertical-align: middle" colspan="2"><strong></strong></td>                                
                                @endforeach
                                @else
                                <td colspan="15" style="vertical-align: middle"><strong>Teste</strong></td>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
                @if(session('status'))
                <div class="alert alert-success">
                    <p class="text-center"><strong>{{ session('status') }}</strong></p>
                </div>
                @endif
            </div>
            <a href="/nicuDataCollect" class="btn btn-success" style="margin-left: 50%; margin-bottom: 20px;">Inserir Novos Dados</a>
        </div>    
    </div>
</div>
</div>
@endsection

