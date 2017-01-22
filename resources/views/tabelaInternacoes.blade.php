@extends('layouts.app')

@section('content')

@if(isset($resultadoExcluir))
<p>{{ $resultadoExcluir }}</p>
@endif
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
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="selMesMensal">Mensal:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="selMesMensal" id="selMesMensal">
                                        <option value="mes">Selecione:</option>
                                        <option value="1" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "1"){{ "selected" }} @else {{ "" }} @endif>Janeiro</option>
                                        <option value="2" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "2"){{ "selected" }} @else {{ "" }} @endif>Fevereiro</option>
                                        <option value="3" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "3"){{ "selected" }} @else {{ "" }} @endif>Março</option>
                                        <option value="4" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "4"){{ "selected" }} @else {{ "" }} @endif>Abril</option>
                                        <option value="5" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "5"){{ "selected" }} @else {{ "" }} @endif>Maio</option>
                                        <option value="6" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "6"){{ "selected" }} @else {{ "" }} @endif>Junho</option>
                                        <option value="7" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "7"){{ "selected" }} @else {{ "" }} @endif>Julho</option>
                                        <option value="8" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "8"){{ "selected" }} @else {{ "" }} @endif>Agosto</option>
                                        <option value="9" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "9"){{ "selected" }} @else {{ "" }} @endif>Setembro</option>
                                        <option value="10" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "10"){{ "selected" }} @else {{ "" }} @endif>Outubro</option>
                                        <option value="11" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "11"){{ "selected" }} @else {{ "" }} @endif>Novembro</option>
                                        <option value="12" @if(isset($request_tabela->selMesMensal) && $request_tabela->selMesMensal == "12"){{ "selected" }} @else {{ "" }} @endif>Dezembro</option>                                    
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-sm-4" for="classificacao">Classificação:</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="classificacao" id="classificacao">
                                        <option value="classifica">Selecione:</option>
                                        <option value="Pouco Urgente" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Pouco Urgente"){{ "selected" }} @else {{ "" }} @endif>Pouco Urgente</option>
                                        <option value="Urgente" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Urgente"){{ "selected" }} @else {{ "" }} @endif>Urgente</option>
                                        <option value="Muito Urgente" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Muito Urgente"){{ "selected" }} @else {{ "" }} @endif>Muito Urgente</option>
                                        <option value="Emergencia" @if(isset($request_tabela->classificacao) && $request_tabela->classificacao == "Emergencia"){{ "selected" }} @else {{ "" }} @endif>Emergência</option>                                                                      
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-lg-2 col-sm-offset-3 col-sm-9">
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
                            <a href="/internacoes" class="btn btn-success">Inserir Nova Internação</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class='row'>        
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center"> Tabela de Internações Procedentes do Pronto Atendimento</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="?">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Data</th>
                                            <th class="text-center">Paciente</th>
                                            <th class="text-center">CID-10</th>
                                            <th class="text-center">Médico PA</th>
                                            <th class="text-center">Remoção</th>
                                            <th class="text-center">Atendimento</th>
                                            <th class="text-center">Local</th>
                                            <th class="text-center">Leito</th>
                                            <th class="text-center">Classificação</th>
                                            <th class="text-center">Especialista</th>
                                            <th class="text-center">Especialidade</th>
                                            <th class="text-center">Alterar</th>
                                            <th class="text-center">Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 12px; font-family: arial;">
                                        @if(isset($resultadoTabelaProcessar))
                                        @forelse($resultadoTabelaProcessar as $resultado)
                                        <tr class="text-center">
                                            <td style="vertical-align: middle;">{{ $resultado->dataInternacao }}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->nome_paciente}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->diagnostico}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->medico_pa}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->remocao}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->nr_atendimento}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->local_internacao}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->Leito}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->classificacao}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->medico_especialista}}</td>
                                            <td style="vertical-align: middle;">{{ $resultado->Especialidade}}</td>
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
                                </table>
                                <a href="/internacoes" class="btn btn-success" style="margin-left: 70%;">Inserir Nova Internação</a>
                            </div>
                        </div>                       
                    </form>
                </div>            
            </div>
        </div>    
    </div>
</div>
</div>
@endsection