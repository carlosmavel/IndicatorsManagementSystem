<?php

namespace Indicators\hospitalization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Hospitalization extends Model {

    public static function hospitalizationInsert($patientName, $diagnostic, $emergencyDoctor, $removal, $serviceNumber, $place, $otherPlace, $bed, $emergency_level, $especialityDoctor, $especiality) {
        if (isset($patientName) == False || strlen($patientName) < 8) {
            return "Nome do Paciente Inválido - Digite o Nome Completo";
        } else if (isset($diagnostic) == False || strlen($diagnostic) == 0) {
            return "CID-10 Inválido";
        } else if (isset($emergencyDoctor) == False || strlen($emergencyDoctor) == 0) {
            return "Médico PA Inválido";
        } else if (isset($removal) == False || strlen($removal) == 0) {
            return "Selecione uma opção de remoção";
        } else if (isset($serviceNumber) == False || strlen($serviceNumber) != 7) {
            return "Número de Atendimento Inválido - Número deve conter 7 dígitos";
        } else if (isset($place) == False || strlen($place) == 0) {
            return "Local Inválido - Selecione um Local";
        } else if ($place == "Outros" && strlen($otherPlace) == 0) {
            return "Digite o Local da Internação";
        } else if (isset($emergency_level) == False || strlen($emergency_level) == 0) {
            return "Selecione uma classificação";
        } else if (isset($especialityDoctor) == False || strlen($especialityDoctor) < 8) {
            return "Digite o nome completo do Médico Especialista";
        } else if (isset($especiality) == False || strlen($especiality) == 0 || $especiality == "selecione") {
            return "Selecione uma especialidade médica válida";
        } else {
            $user_id = Auth::user()->id;
            if ($place == "Outros") {
                DB::insert('INSERT INTO hospitalizations (user_id, patient_name, diagnostic, emergency_doctor, removal, 
                            service_number, hospitalization_place, bed, emergency_level, especiality_doctor, especiality)
                            values(?,?,?,?,?,?,?,?,?,?,?)', [$user_id, $patientName, $diagnostic, $emergencyDoctor, $removal, $serviceNumber, $otherPlace, $bed, $emergency_level, $especialityDoctor, $especiality]);

                return "Sucesso";
            } else if ($place !== "Outros") {
                DB::insert('INSERT INTO hospitalizations (user_id, patient_name, diagnostic, emergency_doctor, removal, 
                            service_number, hospitalization_place, bed, emergency_level, especiality_doctor, especiality)
                            values(?,?,?,?,?,?,?,?,?,?,?)', [$user_id, $patientName, $diagnostic, $emergencyDoctor, $removal, $serviceNumber, $place, $bed, $emergency_level, $especialityDoctor, $especiality]);

                return "Sucesso";
            } else {
                return "erro";
            }
        }
    }

    public static function retornaTabelaInternacoesCompleta() {
        $query = DB::table('hospitalizations')
                ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                ->select('hospitalizations.id', DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")as dataInternacao'), 'hospitalizations.patient_name', 'hospitalizations.diagnostic', 'hospitalizations.emergency_doctor', 'hospitalizations.removal', 'hospitalizations.service_number', 'hospitalizations.hospitalization_place', 'hospitalizations.bed', 'hospitalizations.emergency_level', 'hospitalizations.especiality', 'hospitalizations.especiality_doctor', 'users.*')
                ->where(DB::raw('DATE_FORMAT(hospitalization_date,"%Y%m%d")'), '=', DB::raw('DATE_FORMAT(SYSDATE(),"%Y%m%d")'))
                ->orderby('hospitalizations.hospitalization_place')
                ->orderby('emergency_level')
                ->get();
        return $query;
    }

    public static function returnAllDataHospitalization() {
        $query = DB::table('hospitalizations')
                ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                ->select('hospitalizations.id', DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")as dataInternacao'), 'hospitalizations.patient_name', 'hospitalizations.diagnostic', 'hospitalizations.emergency_doctor', 'hospitalizations.removal', 'hospitalizations.service_number', 'hospitalizations.hospitalization_place', 'hospitalizations.bed', 'hospitalizations.emergency_level', 'hospitalizations.especiality', 'hospitalizations.especiality_doctor', 'users.*')
                ->where(DB::raw('DATE_FORMAT(hospitalization_date,"%Y%m%d")'), '=', DB::raw('DATE_FORMAT(SYSDATE(),"%Y%m%d")'))
                ->orderby('hospitalizations.hospitalization_place')
                ->orderby('emergency_level')
                ->get();
        return $query;
    }

    public static function spreadsheetDiary($date, $urgencyLevel, $place) {
        $query = DB::table('hospitalizations')
                ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                ->where(DB::raw('DATE_FORMAT(hospitalization_date,"%Y-%m-%d")'), '=', $date)
                ->when($place, function($query) use ($place) {
                    return $query->where('hospitalization_place', '=', $place);
                })
                ->when($urgencyLevel, function($query) use ($urgencyLevel) {
                    return $query->where('emergency_level', '=', $urgencyLevel);
                })
                ->select('hospitalizations.id', DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")as dataInternacao'), 'hospitalizations.patient_name', 'hospitalizations.diagnostic', 'hospitalizations.emergency_doctor', 'hospitalizations.removal', 'hospitalizations.service_number', 'hospitalizations.hospitalization_place', 'hospitalizations.bed', 'hospitalizations.emergency_level', 'hospitalizations.especiality', 'hospitalizations.especiality_doctor', 'users.*')
                ->orderby('hospitalization_place')
                ->orderby('emergency_level')
                ->get();
        return $query;
    }

    public static function spreadsheetMonth($month, $urgencyLevel, $place) {
        $query = DB::table('hospitalizations')
                ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                ->where(DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%Y-%m")'), '=', $month)
                ->when($place, function($query) use ($place) {
                    return $query->where('hospitalization_place', '=', $place);
                })
                ->when($urgencyLevel, function($query) use ($urgencyLevel) {
                    return $query->where('emergency_level', '=', $urgencyLevel);
                })
                ->select('hospitalizations.id', DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")as dataInternacao'), 'hospitalizations.patient_name', 'hospitalizations.diagnostic', 'hospitalizations.emergency_doctor', 'hospitalizations.removal', 'hospitalizations.service_number', 'hospitalizations.hospitalization_place', 'hospitalizations.bed', 'hospitalizations.emergency_level', 'hospitalizations.especiality', 'hospitalizations.especiality_doctor', 'users.*')
                ->orderby(DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")'))
                ->orderby('hospitalizations.hospitalization_place')
                ->get();
        return $query;
    }

    public static function spreadsheetUrgencyLevel($urgencyLevel, $place) {
        $query = DB::table('hospitalizations')
                ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                ->where('emergency_level', '=', $urgencyLevel)
                ->when($place, function($query) use ($place) {
                    return $query->where('hospitalization_place', '=', $place);
                })
                ->select('hospitalizations.id', DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")as dataInternacao'), 'hospitalizations.patient_name', 'hospitalizations.diagnostic', 'hospitalizations.emergency_doctor', 'hospitalizations.removal', 'hospitalizations.service_number', 'hospitalizations.hospitalization_place', 'hospitalizations.bed', 'hospitalizations.emergency_level', 'hospitalizations.especiality', 'hospitalizations.especiality_doctor', 'users.*')
                ->orderby(DB::raw('DATE_FORMAT(hospitalizations.hospitalization_date, "%d/%m/%Y")'), 'hospitalizations.hospitalization_place')
                ->get();
        return $query;
    }

    public static function retornaTabelaInternacoes($date, $month, $urgencyLevel, $place) {
        if (isset($date) && $date !== "") {
            $query = Internacao::spreadsheetDiary($date, $urgencyLevel, $place);
            return $query;
        } else if ($date == "" && isset($month) && $month !== "") {
            if (isset($month) && $month !== "") {
                $query = Internacao::spreadsheetMonth($month, $urgencyLevel, $place);
                return $query;
            }
        } else {
            $query = Internacao::spreadsheetUrgencyLevel($urgencyLevel, $place);
            return $query;
        }
    }

    public static function editarInternacoes($id) {
        $query = DB::table('hospitalizations')
                ->where('hospitalizations.id', '=', $id)
                ->get();

        return $query;
    }

    public static function updateInternacao($id, $patientName, $diagnostic, $emergencyDoctor, $removal, $serviceNumber, $place, $otherPlace, $bed, $emergency_level, $especialityDoctor, $especiality) {
        if ($place == "Outros") {
            DB::table('hospitalizations')
                    ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                    ->where('id', $id)
                    ->update(array('patient_name' => $patientName, 'diagnostic' => $diagnostic, 'emergency_doctor' => $emergencyDoctor, 'removal' => $removal, 'service_number' => $serviceNumber, 'hospitalization_place' => $otherPlace, 'bed' => $bed, 'emergency_level' => $emergency_level, 'especiality' => $especiality, 'especiality_doctor' => $especialityDoctor));

            return "Sucesso";
        } else {
            DB::table('hospitalizations')
                    ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                    ->where('id', $id)
                    ->update(array('patient_name' => $patientName, 'diagnostic' => $diagnostic, 'emergency_doctor' => $emergencyDoctor, 'removal' => $removal, 'service_number' => $serviceNumber, 'hospitalization_place' => $place, 'bed' => $bed, 'emergency_level' => $emergency_level, 'especiality' => $especiality, 'especiality_doctor' => $especialityDoctor));

            return "Sucesso";
        }
    }

    public static function deleteInternacao($id) {
        DB::table('hospitalizations')
                ->join('users', 'hospitalizations.user_id', '=', 'users.id')
                ->where('id', $id)
                ->delete();
        return "Dados deletados com Sucesso";
    }

}
