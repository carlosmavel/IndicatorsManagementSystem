<?php

namespace Indicators\Http\Controllers\icu;

use Indicators\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Indicators\icu\Icu;


class IcuController extends Controller {

    public function icuMain() {
        
        return view('icu.icuMain');
    }

    public function icuDataCollect() {
        return view('icu.icuDataCollect');
    }

    public function icuIndicators() {
        return view('icu.icuIndicators');
    }    
    
    public function icuInsertData(Request $request) {
        $insertResult = Icu::icuInsertData($request->uppExposed, $request->uppCase, $request->pvCatheter, $request->phlebitisCase, $request->nasogastricTube, $request->nasogastricTubeLost, $request->falls, $request->extubatedPatient, $request->intubatedPatient, $request->icuReentry, $request->deaths, $request->bloquedBed);
            return view('icu.icuDataCollect', compact('insertResult', 'request'));
        
    }
    
    public function returnIcuTable(){
        $results = Icu::returnIcuTable();
            return view('icu.icuTable', compact('results','deleteResults'));
    }
    
    public function returnIcuTableFilter(Request $request) {
        $results = Icu::returnIcuTableFilter($request->monthFilter);
        return view('icu.icuTable', compact('results', 'request'));
    }
    
    public function returnDataEdit(Request $request_id) {
        $results = Icu::dataEdit($request_id->id);
            return view('icu.icuEdit', compact('results'));
    }
    
    public function dataUpdate(Request $request){
        $editResults = Icu::dataUpdate($request->id, $request->uppExposed, $request->uppCase, $request->pvCatheter, $request->phlebitisCase, $request->nasogastricTube, $request->nasogastricTubeLost, $request->falls, $request->extubatedPatient, $request->intubatedPatient, $request->icuReentry, $request->deaths, $request->bloquedBed);
        if (isset($editResults) && $editResults == "Sucesso") {
            return redirect()->action('icu\IcuController@returnIcuTable', compact('editResults'));
        } else {
            return view('icu.icuEdit', compact('editResults', 'request'));
        }
    }
    
    public static function dataDelete(Request $request) {
        $deleteResults = Icu::dataDelete($request->id);
        if (isset($deleteResults)) {
            return back()->with('status', $deleteResults);
        } else {
            return back()->with('status', 'Erro na exclusão do dado');
        }
    }

}
