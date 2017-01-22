<?php

namespace Indicators\Http\Controllers\nicu;

use Indicators\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Indicators\nicu\Nicu;

class NicuController extends Controller {

    public function nicuMain() {

        return view('nicu.nicuMain');
    }

    public function nicuDataCollect() {
        return view('nicu.nicuDataCollect');
    }

    public function nicuIndicators() {
        return view('nicu.nicuIndicators');
    }

    public function nicuInsertData(Request $request) {
        $insertResult = Nicu::nicuInsertData($request->uppExposed, $request->uppCase, $request->pvCatheter, $request->phlebitisCase, $request->nasogastricTube, $request->nasogastricTubeLost, $request->falls, $request->deathsLess1500, $request->dischargesLess1500, $request->deathsBetween1500And2500, $request->deathsHigher2500, $request->dischargesBetween1500And2500, $request->extubatedPatient, $request->intubatedPatient, $request->bloquedBed);
        return view('nicu.nicuDataCollect', compact('insertResult', 'request'));
    }

    public function returnNicuTable() {
        $results = Nicu::returnNicuTable();
        $sum[] = array(1 => $results->sum('pressure_ulcer_exposed'), 2 => $results->sum('pressure_ulcer_case'), 3 => $results->sum('patient_pv_catheter'), 4 => $results->sum('phlebitis_case'), 5 => $results->sum('nasogastric_tube'), 6 => $results->sum('nasogastric_tube_lost'), 7 => $results->sum('falls_number'), 8 => $results->sum('deaths_less_1500'), 9 => $results->sum('discharges_less_1500'), 10 => $results->sum('deaths_between_1500_2500'), 11 => $results->sum('deaths_higher_2500'), 12 => $results->sum('discharges_between_1500_2500'), 13 => $results->sum('extubated_patient'), 14 => $results->sum('intubated_patient'), 15 => $results->sum('bloqued_bed'));
        return view('nicu.nicuTable', compact('results', 'sum'));
    }

    public function returnNicuTableFilter(Request $request) {
        $results = Nicu::returnNicuTableFilter($request->monthFilter);
        $sum[] = array(1 => $results->sum('pressure_ulcer_exposed'), 2 => $results->sum('pressure_ulcer_case'), 3 => $results->sum('patient_pv_catheter'), 4 => $results->sum('phlebitis_case'), 5 => $results->sum('nasogastric_tube'), 6 => $results->sum('nasogastric_tube_lost'), 7 => $results->sum('falls_number'), 8 => $results->sum('deaths_less_1500'), 9 => $results->sum('discharges_less_1500'), 10 => $results->sum('deaths_between_1500_2500'), 11 => $results->sum('deaths_higher_2500'), 12 => $results->sum('discharges_between_1500_2500'), 13 => $results->sum('extubated_patient'), 14 => $results->sum('intubated_patient'), 15 => $results->sum('bloqued_bed'));
        return view('nicu.nicuTable', compact('results', 'request', 'sum'));
    }

    public function returnDataEdit(Request $request_id) {
        $results = Nicu::dataEdit($request_id->id);
        return view('nicu.nicuEdit', compact('results'));
    }

    public function dataUpdate(Request $request) {
        $editResults = Nicu::dataUpdate($request->id, $request->uppExposed, $request->uppCase, $request->pvCatheter, $request->phlebitisCase, $request->nasogastricTube, $request->nasogastricTubeLost, $request->falls, $request->deathsLess1500, $request->dischargesLess1500, $request->deathsBetween1500And2500, $request->deathsHigher2500, $request->dischargesBetween1500And2500, $request->extubatedPatient, $request->intubatedPatient, $request->bloquedBed);
        if (isset($editResults) && $editResults == "Sucesso") {
            return redirect()->action('nicu\NicuController@returnNicuTable', compact('editResults'));
        } else {
            return view('nicu.nicuEdit', compact('editResults', 'request'));
        }
    }

    public static function dataDelete(Request $request) {
        $deleteResults = Nicu::dataDelete($request->id);
        if (isset($deleteResults)) {
            return back()->with('status', $deleteResults);
        } else {
            return back()->with('status', 'Erro na exclusão do dado');
        }
    }

}
