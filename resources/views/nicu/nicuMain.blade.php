@extends('layouts.nicuMaster')


@section('content')
     <div class='container' style="margin-top: 70px">
       <div class='row'>
            <div class='col-lg-4 bg-success'>
                <a href="/nicuIndicators"><i class="fa fa-bar-chart" aria-hidden="true"></i> Indicadores</a>
            </div>
       </div>
    </div>
    <br>
    <div class='container'>
       <div class='row'>
            <div class='col-lg-4 bg-success'>
                <a href="/nicuDataCollect"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Coleta de Dados</a>
            </div>
       </div>
    </div>
    <br>
    <div class='container'>
       <div class='row'>
            <div class='col-lg-4 bg-success'>
                <a href="/nicuTable"><i class="fa fa-table" aria-hidden="true"></i> Tabela de Dados</a>
            </div>
       </div>
    </div>
@endsection