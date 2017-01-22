<?php

namespace Indicators\icu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Icu extends Model {

    public static function icuInsertData($uppExposed, $uppCase, $pvCatheter, $phlebitisCase, $nasogastricTube, $nasogastricTubeLost, $falls, $extubatedPatient, $intubatedPatient, $icuReentry, $deaths, $bloquedBed) {
        $usuario_id = Auth::user()->id;
        DB::insert('INSERT INTO icu_data_collect (user_id, pressure_ulcer_exposed, pressure_ulcer_case, patient_pv_catheter, phlebitis_case, nasogastric_tube, nasogastric_tube_lost, falls_number, extubated_patient, intubated_patient, icu_reentry, death_number, bloqued_bed)
                        values(?,?,?,?,?,?,?,?,?,?,?,?,?)', [$usuario_id, $uppExposed, $uppCase, $pvCatheter, $phlebitisCase, $nasogastricTube, $nasogastricTubeLost, $falls, $extubatedPatient, $intubatedPatient, $icuReentry, $deaths, $bloquedBed]);
        return "Sucesso";
    }

    public static function returnIcuTable() {
        $query = DB::table('icu_data_collect')
                ->join('users', 'icu_data_collect.user_id', '=', 'users.id')
                ->select('icu_data_collect.id', DB::raw('DATE_FORMAT(icu_data_collect.date_time, "%d/%m/%Y") as date'), 'pressure_ulcer_exposed', 'pressure_ulcer_case', 'patient_pv_catheter', 'phlebitis_case', 'nasogastric_tube', 'nasogastric_tube_lost', 'falls_number', 'extubated_patient', 'intubated_patient', 'icu_reentry', 'death_number', 'bloqued_bed')
                ->where(DB::raw('DATE_FORMAT(date_time,"%Y%m")'), '=', DB::raw('DATE_FORMAT(SYSDATE(),"%Y%m")'))
                ->orderby('icu_data_collect.date_time')
                ->get();
        return $query;
    }
    
    public static function returnIcuTableFilter($month){
        $query = DB::table('icu_data_collect')
                ->join('users', 'icu_data_collect.user_id', '=', 'users.id')
                ->select('icu_data_collect.id', DB::raw('DATE_FORMAT(icu_data_collect.date_time, "%d/%m/%Y") as date'), 'pressure_ulcer_exposed', 'pressure_ulcer_case', 'patient_pv_catheter', 'phlebitis_case', 'nasogastric_tube', 'nasogastric_tube_lost', 'falls_number', 'extubated_patient', 'intubated_patient', 'icu_reentry', 'death_number', 'bloqued_bed')
                ->where(DB::raw('DATE_FORMAT(date_time,"%Y-%m")'), '=', $month)
                ->orderby('icu_data_collect.date_time')
                ->get();
        return $query;
    }

    public static function dataEdit($id) {
        $query = DB::table('icu_data_collect')
                ->where('icu_data_collect.id', $id)
                ->get();        
        return $query;
    }

    public static function dataUpdate($id, $uppExposed, $uppCase, $pvCatheter, $phlebitisCase, $nasogastricTube, $nasogastricTubeLost, $falls, $extubatedPatient, $intubatedPatient, $icuReentry, $deaths, $bloquedBed) {
        DB::table('icu_data_collect')
                ->join('users', 'icu_data_collect.user_id', '=', 'users.id')
                ->where('icu_data_collect.id', $id)
                ->update(array('pressure_ulcer_exposed' => $uppExposed, 'pressure_ulcer_case' => $uppCase, 'patient_pv_catheter' => $pvCatheter, 'phlebitis_case' => $phlebitisCase, 'nasogastric_tube' => $nasogastricTube, 'nasogastric_tube_lost' => $nasogastricTubeLost, 'falls_number' => $falls, 'extubated_patient' => $extubatedPatient, 'intubated_patient' => $intubatedPatient, 'icu_reentry' => $icuReentry, 'death_number' => $deaths,'bloqued_bed' => $bloquedBed));
        return "Sucesso";
    }
    
    public static function dataDelete($id) {
        DB::table('icu_data_collect')
                ->join('users', 'icu_data_collect.user_id', '=', 'users.id')
                ->where('icu_data_collect.id', $id)
                ->delete();
        return "Dados deletados com Sucesso";
    }

}
