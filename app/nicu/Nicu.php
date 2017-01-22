<?php

namespace Indicators\nicu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Nicu extends Model
{
                                                                                                             
   public static function nicuInsertData($uppExposed, $uppCase, $pvCatheter, $phlebitisCase, $nasogastricTube, $nasogastricTubeLost, $falls, $deathsLess1500, $dischargesLess1500, $deathsBetween1500And2500, $deathsHigher2500, $dischargesBetween1500And2500, $extubatedPatient, $intubatedPatient, $bloquedBed) {
        $usuario_id = Auth::user()->id;
        DB::insert('INSERT INTO nicu_data_collect (user_id, pressure_ulcer_exposed, pressure_ulcer_case, patient_pv_catheter, phlebitis_case, nasogastric_tube, nasogastric_tube_lost, falls_number, deaths_less_1500, discharges_less_1500, deaths_between_1500_2500, deaths_higher_2500, discharges_between_1500_2500, extubated_patient, intubated_patient, bloqued_bed)
                        values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$usuario_id, $uppExposed, $uppCase, $pvCatheter, $phlebitisCase, $nasogastricTube, $nasogastricTubeLost, $falls, $deathsLess1500, $dischargesLess1500, $deathsBetween1500And2500, $deathsHigher2500, $dischargesBetween1500And2500, $extubatedPatient, $intubatedPatient, $bloquedBed]);
        return "Sucesso";
    }

    public static function returnNicuTable() {
        $query = DB::table('nicu_data_collect')
                ->join('users', 'nicu_data_collect.user_id', '=', 'users.id')
                ->select('nicu_data_collect.id', DB::raw('DATE_FORMAT(nicu_data_collect.date_time, "%d/%m/%Y") as date'), 'pressure_ulcer_exposed', 'pressure_ulcer_case', 'patient_pv_catheter', 'phlebitis_case', 'nasogastric_tube', 'nasogastric_tube_lost', 'falls_number', 'deaths_less_1500', 'discharges_less_1500', 'deaths_between_1500_2500', 'deaths_higher_2500', 'discharges_between_1500_2500', 'extubated_patient', 'intubated_patient', 'bloqued_bed')
                ->where(DB::raw('DATE_FORMAT(date_time,"%Y%m")'), '=', DB::raw('DATE_FORMAT(SYSDATE(),"%Y%m")'))
                ->orderby('nicu_data_collect.date_time')
                ->get();
        return $query;
    }
    
    public static function returnNicuTableFilter($month) {
        $query = DB::table('nicu_data_collect')
                ->join('users', 'nicu_data_collect.user_id', '=', 'users.id')
                ->select('nicu_data_collect.id', DB::raw('DATE_FORMAT(nicu_data_collect.date_time, "%d/%m/%Y") as date'), 'pressure_ulcer_exposed', 'pressure_ulcer_case', 'patient_pv_catheter', 'phlebitis_case', 'nasogastric_tube', 'nasogastric_tube_lost', 'falls_number', 'deaths_less_1500', 'discharges_less_1500', 'deaths_between_1500_2500', 'deaths_higher_2500', 'discharges_between_1500_2500', 'extubated_patient', 'intubated_patient', 'bloqued_bed')
                ->where(DB::raw('DATE_FORMAT(date_time,"%Y-%m")'), '=', $month)
                ->orderby('nicu_data_collect.date_time')
                ->get();
        return $query;
    }

    public static function dataEdit($id) {
        $query = DB::table('nicu_data_collect')
                ->where('nicu_data_collect.id', $id)
                ->get();
        return $query;
    }

    public static function dataUpdate($id, $uppExposed, $uppCase, $pvCatheter, $phlebitisCase, $nasogastricTube, $nasogastricTubeLost, $falls, $deathsLess1500, $dischargesLess1500, $deathsBetween1500And2500, $deathsHigher2500, $dischargesBetween1500And2500, $extubatedPatient, $intubatedPatient, $bloquedBed) {
        DB::table('nicu_data_collect')
                ->join('users', 'nicu_data_collect.user_id', '=', 'users.id')
                ->where('nicu_data_collect.id', $id)
                ->update(array('pressure_ulcer_exposed' => $uppExposed, 'pressure_ulcer_case' => $uppCase, 'patient_pv_catheter' => $pvCatheter, 'phlebitis_case' => $phlebitisCase, 'nasogastric_tube' => $nasogastricTube, 'nasogastric_tube_lost' => $nasogastricTubeLost, 'falls_number' => $falls, 'deaths_less_1500' => $deathsLess1500, 'discharges_less_1500' => $dischargesLess1500, 'deaths_between_1500_2500' => $deathsBetween1500And2500, 'deaths_higher_2500' => $deathsHigher2500, 'discharges_between_1500_2500' => $dischargesBetween1500And2500, 'extubated_patient' => $extubatedPatient, 'intubated_patient' => $intubatedPatient, 'bloqued_bed' => $bloquedBed));
        return "Sucesso";
    }
    
    public static function dataDelete($id) {
        DB::table('nicu_data_collect')
                ->join('users', 'nicu_data_collect.user_id', '=', 'users.id')
                ->where('nicu_data_collect.id', $id)
                ->delete();
        return "Dados deletados com Sucesso";
    }
}
