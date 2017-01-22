<?php

namespace Indicators\Http\Controllers;

use Illuminate\Http\Request;
use Indicators\Internacao;
use Carbon\Carbon;


class InternacoesController extends Controller
{
    public function internacoes() {
        return view('internacoes');
    }

    public function internacoesProcessar(Request $request) {
        $resultadoProcessar = Internacao::inserirInternacao($request->nomePaciente, $request->diagnostico, $request->medicoPA, $request->optradioremocao, $request->numeroAtendimento, $request->optradiolocal, $request->outroLocal, $request->leito, $request->optRadioClassificacao, $request->medicoEspecialista, $request->selEspecialidade);

        
            return view('internacoes', compact('resultadoProcessar', 'request'));
        
    }

    public function tabelaInternacoes() {
        $resultadoTabelaProcessar = Internacao::retornaTabelaInternacoesCompleta();
        setlocale(LC_ALL, 'Portuguese_Brazilian');
        $hoje = Carbon::now('America/Sao_Paulo');
        return view('tabelaInternacoes', compact('resultadoTabelaProcessar', 'hoje', 'resultadoExcluir'));
    }

    public function tabelaProcessar(Request $request_tabela) {
        $resultadoTabelaProcessar = Internacao::retornaTabelaInternacoes($request_tabela->date, $request_tabela->selMesMensal, $request_tabela->classificacao);


        return view('tabelaInternacoes', compact('resultadoTabelaProcessar', 'request_tabela'));
    }

    public function internacoesEditar(Request $request_id) {
        $resultadoEditar = Internacao::editarInternacoes($request_id->id);

        return view('internacoesAlterar', compact('resultadoEditar'));
    }

    public function internacoesAtualizar(Request $request) {
        $resultadoAtualizar = Internacao::updateInternacao($request->id, $request->nomePaciente, $request->diagnostico, $request->medicoPA, $request->optradioremocao, $request->numeroAtendimento, $request->optradiolocal, $request->outroLocal, $request->leito, $request->optRadioClassificacao, $request->medicoEspecialista, $request->selEspecialidade);

        if (isset($resultadoAtualizar) && $resultadoAtualizar == "Sucesso") {
            return redirect()->action('InternacoesController@tabelaInternacoes');
        } else {
            return view('internacoesAlterar', compact('resultadoAtualizar', 'request'));
        }
    }

    public function internacoesExcluir(Request $request) {
        $resultadoExcluir = Internacao::deleteInternacao($request->id);

        if (isset($resultadoExcluir) && $resultadoExcluir == "Sucesso") {
            return redirect()->action('InternacoesController@tabelaInternacoes', compact('resultadoExcluir'));
        } else {
            $resultadoExcluir = "erro na exclusão";
            return redirect()->action('InternacoesController@tabelaInternacoes', compact('resultadoExcluir'));
        }
    }
}
