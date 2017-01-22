<?php

namespace Indicators\Http\Controllers\pa;

use Indicators\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Indicators\Internacao;


class PaController extends Controller
{
    public function paDataCollect() {
        return view('pa.paDataCollect');
    }
    
    public function paIndicators() {
        return view('pa.paIndicators');
    }

    public function admissionProcess(Request $request) {
        $resultadoProcessar = Internacao::inserirInternacao($request->nomePaciente, $request->diagnostico, $request->medicoPA, $request->optradioremocao, $request->numeroAtendimento, $request->optradiolocal, $request->outroLocal, $request->leito, $request->optRadioClassificacao, $request->medicoEspecialista, $request->selEspecialidade);
            return view('pa.paDataCollect', compact('resultadoProcessar', 'request'));
    }

    public function paTable() {
        $resultadoTabelaProcessar = Internacao::retornaTabelaInternacoesCompleta();
        $count = $resultadoTabelaProcessar->count();
        $countMh = $resultadoTabelaProcessar->where('local_internacao', 'Meu Hospital')->count();
        $countSTA = $resultadoTabelaProcessar->where('local_internacao', 'Santa Casa')->count();
        $countHospitalista = $resultadoTabelaProcessar->where('Especialidade', 'Hospitalista')->count();
            return view('pa.paTable', compact('resultadoTabelaProcessar', 'resultadoExcluir', 'count', 'countMh', 'countSTA', 'countHospitalista'));
    }

    public function tableProcess(Request $request_tabela) {
        $resultadoTabelaProcessar = Internacao::retornaTabelaInternacoes($request_tabela->date, $request_tabela->month, $request_tabela->classificacao, $request_tabela->place);
        $count = $resultadoTabelaProcessar->count();
        $countMh = $resultadoTabelaProcessar->where('local_internacao', 'Meu Hospital')->count();
        $countSTA = $resultadoTabelaProcessar->where('local_internacao', 'Santa Casa')->count();
        $countOutros = $resultadoTabelaProcessar->where('local_internacao', '!==', 'Meu Hospital')->where('local_internacao', '!==', 'Santa Casa' )->count();
        $countHospitalista = $resultadoTabelaProcessar->where('Especialidade', 'Hospitalista')->count();
            return view('pa.paTable', compact('resultadoTabelaProcessar', 'request_tabela', 'count', 'countMh', 'countSTA', 'countOutros', 'countHospitalista'));
    }

    public function internacoesEditar(Request $request_id) {
        $resultadoEditar = Internacao::editarInternacoes($request_id->id);
            return view('pa.internacoesAlterar', compact('resultadoEditar'));
    }

    public function internacoesAtualizar(Request $request) {
        $resultadoAtualizar = Internacao::updateInternacao($request->id, ucwords(strtolower($request->nomePaciente)), ucwords(strtolower($request->diagnostico)), $request->medicoPA, $request->optradioremocao, $request->numeroAtendimento, $request->optradiolocal, ucwords(strtolower($request->outroLocal)), ucwords(strtolower($request->leito)), $request->optRadioClassificacao, $request->medicoEspecialista, $request->selEspecialidade);
        if (isset($resultadoAtualizar) && $resultadoAtualizar == "Sucesso") {
            return redirect()->action('pa\PaController@paTable');
        } else {
            return view('pa.internacoesAlterar', compact('resultadoAtualizar', 'request'));
        }
    }

    public function internacoesExcluir(Request $request) {
        $deleteResults = Internacao::deleteInternacao($request->id);
        if (isset($deleteResults)) {
            return back()->with('status', $deleteResults);
        } else {
            return back()->with('status', 'Erro na exclusão do dado');
        }
    }   
    
}
