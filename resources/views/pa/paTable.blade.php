@extends('layouts.paMaster')

@section('content')

<div class='container-fluid'>    

    <button class="btn btn-success" style="margin-bottom: 10px; margin-left: 10px;" data-toggle="collapse" data-target="#filtro">Filtros <i class="fa fa-arrows-v" aria-hidden="true"></i></button>

    <div id="filtro" class="collapse">
        <div class='row' style="margin: 15px">        
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Selecione o Filtro Desejado</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="?">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="date">Data:</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="date" name="date" value="@if(isset($request_tabela->date)){{ $request_tabela->date }}@endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="month">Mensal:</label>
                                <div class="col-sm-8">
                                    <input type="month" class="form-control" id="month" name="month" value="@if(isset($request_tabela->month)){{ $request_tabela->month }}@endif">                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="classificacao">Classificação:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="classificacao" id="classificacao">
                                        <option value="">Selecione:</option>
                                        <option value="Pouco Urgente" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Pouco Urgente"){{ "selected" }} @else {{ "" }} @endif>Pouco Urgente</option>
                                        <option value="Urgente" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Urgente"){{ "selected" }} @else {{ "" }} @endif>Urgente</option>
                                        <option value="Muito Urgente" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Muito Urgente"){{ "selected" }} @else {{ "" }} @endif>Muito Urgente</option>
                                        <option value="Emergencia" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Emergencia"){{ "selected" }} @else {{ "" }} @endif>Emergência</option>                                                                      
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="place">Local:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="place" id="place">
                                        <option value="">Selecione:</option>
                                        <option value="Meu Hospital" @if(isset($request_tabela->place) && $request_tabela->place == "Meu Hospital"){{ "selected" }} @else {{ "" }} @endif>Meu Hospital</option>
                                        <option value="Santa Casa" @if(isset($request_tabela->place) && $request_tabela->place == "Santa Casa"){{ "selected" }} @else {{ "" }} @endif>Santa Casa</option>
                                        <option value="Outros" @if(isset($request_tabela->place) && $request_tabela->place == "Outros"){{ "selected" }} @else {{ "" }} @endif>Outros</option>                                        
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-lg-2 col-sm-offset-3 col-sm-3">
                                    <button type="submit" class="btn btn-default">Enviar</button> 				    
                                </div>
                            </div>                                                       
                        </form>    
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">Inserir Nova Internação</div>
                    <div class="panel-body">
                        <div class="form-group">

                            <hr>
                            <a href="/paDataCollect" class="btn btn-success">Inserir Nova Internação</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class='row'>        
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center" style="font-size: 16px;"><strong><i class="fa fa-table" aria-hidden="true"></i> Tabela de Internações Procedentes do Pronto Atendimento</strong></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr class="bg-success">
                                    <th class="text-center">Data</th>
                                    <th class="text-center">Atend</th>
                                    <th class="text-center">Paciente</th>                                    
                                    <th class="text-center">Médico PA</th>
                                    <th class="text-center">Remoção</th>                                    
                                    <th class="text-center">Local</th>
                                    <th class="text-center">Leito</th>                                    
                                    <th class="text-center">Especialista</th>
                                    <th class="text-center">Especialidade</th>
                                    <th class="text-center">Classificação</th>
                                    <th class="text-center">CID-10</th>
                                    <th class="text-center">Alterar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px; font-family: arial;">
                                @if(isset($resultadoTabelaProcessar))
                                @forelse($resultadoTabelaProcessar as $resultado)
                                <tr class="text-center">
                                    <td style="vertical-align: middle;">{{ $resultado->dataInternacao }}</td>
                                    <td style="vertical-align: middle;">{{ $resultado->nr_atendimento}}</td>
                                    <td style="vertical-align: middle;">{{ $resultado->nome_paciente}}</td>
                                    <td style="vertical-align: middle;">{{ $resultado->medico_pa}}</td>
                                    <td style="vertical-align: middle;">{{ $resultado->remocao}}</td>
                                    @if($resultado->local_internacao == "Meu Hospital")
                                    <td style="vertical-align: middle; color: #5a9e52;"><strong>{{ $resultado->local_internacao}}</strong></td>
                                    @elseif($resultado->local_internacao == "Santa Casa")
                                    <td style="vertical-align: middle; color: #4b8eb7;"><strong>{{ $resultado->local_internacao}}</strong></td>
                                    @else
                                    <td style="vertical-align: middle; color: #673ab7;"><strong>{{ $resultado->local_internacao}}</strong></td>
                                    @endif
                                    <td style="vertical-align: middle;">{{ $resultado->Leito}}</td>
                                    <td style="vertical-align: middle;">{{ $resultado->medico_especialista}}</td>
                                    <td style="vertical-align: middle;">{{ $resultado->Especialidade}}</td>
                                    
                                    @if($resultado->classificacao == "Pouco Urgente")                                    
                                    <td style="vertical-align: middle; color: #4caf50;"><strong>{{ $resultado->classificacao}}</strong></td>
                                    <td style="vertical-align: middle; color: #4caf50;"><strong>{{ $resultado->diagnostico}}</strong> </td>
                                    @elseif($resultado->classificacao == "Urgente")
                                    <td style="vertical-align: middle; color: #d6c214;"><strong>{{ $resultado->classificacao}}</strong> </td>
                                    <td style="vertical-align: middle; color: #d6c214;"><strong>{{ $resultado->diagnostico}}</strong> </td>
                                    @elseif($resultado->classificacao == "Muito Urgente")
                                    <td style="vertical-align: middle; color: #ef930b;"><strong>{{ $resultado->classificacao}}</strong> </td>
                                    <td style="vertical-align: middle; color: #ef930b;"><strong>{{ $resultado->diagnostico}}</strong> </td>
                                    @else
                                    <td style="vertical-align: middle; color: #c13d34;"><strong>{{ $resultado->classificacao}}</strong> </td>
                                    <td style="vertical-align: middle; color: #c13d34;"><strong>{{ $resultado->diagnostico}}</strong> </td>
                                    @endif
                                                                       
                                    <td style="vertical-align: middle;"><a href="/internacoesAlterar?id={{ $resultado->i_id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                    <td style="vertical-align: middle;"><a href="/internacoesExcluir?id={{ $resultado->i_id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="13"><strong>Nenhuma informação encontrada</strong></td>
                                </tr>
                                @endforelse
                                @endif
                            </tbody>
                            <tfoot class="bg-success text-center">
                                @if(isset($count) && $count == 1)
                                <td colspan="13" style="vertical-align: middle"><strong> Total de {{ $count }} Internação</strong></td>
                                @elseif(isset($count) && $count > 1)
                                <td colspan="13" style="vertical-align: middle"><strong> Total de {{ $count }} Internações &nbsp - &nbsp  {{ $countMh }} Meu Hospital &nbsp - &nbsp  {{ $countSTA }} Santa Casa &nbsp - &nbsp  {{ $countOutros }} Outros Hospitais</strong></td>
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
        </div>
        <a href="/paDataCollect" class="btn btn-success" style="margin-left: 50%; margin-bottom: 20px;">Inserir Nova Internação</a>
    </div>
</div>

@endsection