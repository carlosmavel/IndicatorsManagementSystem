<?php

namespace Indicators\Http\Controllers\teste;

use Indicators\Http\Controllers\Controller;
//use Indicators\User;
//use Indicators\appraisal\Appraisal;
//use Illuminate\Support\Facades\Auth;
//use Indicators\user\notes\Notes;
//use Indicators\Department;
//use Khill\Lavacharts\Lavacharts;
//use Indicators\Internacao;
use Indicators\hospitalization\Hospitalization;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function testeDataCollect() {
        return view('teste');
    }
    
    public function paIndicators() {
        return view('teste');
    }

    public function admissionProcess(Request $request) {
        $processResult = Hospitalization::hospitalizationInsert($request->patientName, $request->diagnostic, $request->emergencyDoctor, $request->removal, $request->serviceNumber, $request->place, $request->otherPlace, $request->bed, $request->emergency_level, $request->especialityDoctor, $request->especiality);
            return view('teste', compact('processResult', 'request'));
    }

    public function paTable() {
        $resultadoTabelaProcessar = Internacao::retornaTabelaInternacoesCompleta();
        $count = $resultadoTabelaProcessar->count();
        $countHU = $resultadoTabelaProcessar->where('local_internacao', 'Hospital Unimed')->count();
        $countSTA = $resultadoTabelaProcessar->where('local_internacao', 'Santa Casa')->count();
        $countHospitalista = $resultadoTabelaProcessar->where('Especialidade', 'Hospitalista')->count();
            return view('pa.paTable', compact('resultadoTabelaProcessar', 'resultadoExcluir', 'count', 'countHU', 'countSTA', 'countHospitalista'));
    }

    public function tableProcess(Request $request_tabela) {
        $resultadoTabelaProcessar = Internacao::retornaTabelaInternacoes($request_tabela->date, $request_tabela->month, $request_tabela->classificacao, $request_tabela->place);
        $count = $resultadoTabelaProcessar->count();
        $countHU = $resultadoTabelaProcessar->where('local_internacao', 'Hospital Unimed')->count();
        $countSTA = $resultadoTabelaProcessar->where('local_internacao', 'Santa Casa')->count();
        $countHospitalista = $resultadoTabelaProcessar->where('Especialidade', 'Hospitalista')->count();
            return view('pa.paTable', compact('resultadoTabelaProcessar', 'request_tabela', 'count', 'countHU', 'countSTA', 'countHospitalista'));
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

    
    
    
    /*public function teste() {
        
        /*$users = User::has('appraisals')->get();
        $appraisal = Appraisal::wherehas('user', function($query){
            $query->where('user_id', '=', Auth::user()->id);            
        })->get();
        
        
        $notes = Notes::wherehas('appraisal', function($query){
            $query->where('appraisals.user_id', '=', Auth::user()->id);            
        })->get();
        
        $testi = Notes::with('appraisal')->get();
        
        //$departments = Department::returnDepartments();
        
        $internacoes = Hospitalization::all()->groupBy('Especialidade');
       
        
        //$chart = new Lavacharts();
        
        
        
        
        return view('teste', compact('departments', 'internacoes'));
    }*/

