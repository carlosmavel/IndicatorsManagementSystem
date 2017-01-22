<?php

namespace Indicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Internacao extends Model {

    public static function inserirInternacao($nomePaciente, $diagnostico, $medicoPA, $remocao, $numeroAtendimento, $local, $outroLocal, $leito, $classificacao, $medicoEspecialista, $selEspecialidade) {
        if (isset($nomePaciente) == False || strlen($nomePaciente) < 8) {
            return "Nome do Paciente Inválido - Digite o Nome Completo";
        } else if (isset($diagnostico) == False || strlen($diagnostico) == 0) {
            return "CID-10 Inválido";
        } else if (isset($medicoPA) == False || strlen($medicoPA) == 0) {
            return "Médico PA Inválido";
        } else if (isset($remocao) == False || strlen($remocao) == 0) {
            return "Selecione uma opção de remoção";
        } else if (isset($numeroAtendimento) == False || strlen($numeroAtendimento) != 7) {
            return "Número de Atendimento Inválido - Número deve conter 7 dígitos";
        } else if (isset($local) == False || strlen($local) == 0) {
            return "Local Inválido - Selecione um Local";
        } else if ($local == "Outros" && strlen($outroLocal) == 0) {
            return "Digite o Local da Internação";
        } else if (isset($classificacao) == False || strlen($classificacao) == 0) {
            return "Selecione uma classificação";
        } else if (isset($medicoEspecialista) == False || strlen($medicoEspecialista) < 8) {
            return "Digite o nome completo do Médico Especialista";
        } else if (isset($selEspecialidade) == False || strlen($selEspecialidade) == 0 || $selEspecialidade == "selecione") {
            return "Selecione uma especialidade médica válida";
        } else {
            $nomePaciente = ucwords(strtolower($nomePaciente));
            $diagnostico = ucwords(strtolower($diagnostico));
            $usuario_id = Auth::user()->id;
            if ($local == "Outros") {
                DB::insert('INSERT INTO internacoes (u_id, nome_paciente, diagnostico, medico_pa, remocao, 
                        nr_atendimento, local_internacao, Leito, classificacao, medico_especialista, Especialidade)
                        values(?,?,?,?,?,?,?,?,?,?,?)', [$usuario_id, $nomePaciente, $diagnostico, $medicoPA, $remocao, $numeroAtendimento, $outroLocal, $leito, $classificacao, $medicoEspecialista, $selEspecialidade]);

                return "Sucesso";
            } else if ($local !== "Outros") {
                DB::insert('INSERT INTO internacoes (u_id, nome_paciente, diagnostico, medico_pa, remocao, 
                        nr_atendimento, local_internacao, Leito, classificacao, medico_especialista, Especialidade)
                        values(?,?,?,?,?,?,?,?,?,?,?)', [$usuario_id, $nomePaciente, $diagnostico, $medicoPA, $remocao, $numeroAtendimento, $local, $leito, $classificacao, $medicoEspecialista, $selEspecialidade]);

                return "Sucesso";
            } else {
                return "erro";
            }
        }
    }

    public static function retornaTabelaInternacoesCompleta() {
        $query = DB::table('internacoes')
                ->join('users', 'internacoes.u_id', '=', 'users.id')
                ->select('internacoes.i_id', DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")as dataInternacao'), 'internacoes.nome_paciente', 'internacoes.diagnostico', 'internacoes.medico_pa', 'internacoes.remocao', 'internacoes.nr_atendimento', 'internacoes.local_internacao', 'internacoes.Leito', 'internacoes.classificacao', 'internacoes.Especialidade', 'internacoes.medico_especialista', 'users.*')
                ->where(DB::raw('DATE_FORMAT(data_internacao,"%Y%m%d")'), '=', DB::raw('DATE_FORMAT(SYSDATE(),"%Y%m%d")'))
                ->orderby('internacoes.local_internacao')
                ->orderby('classificacao')
                ->get();
        return $query;
    }

    public static function spreadsheetDiary($date, $urgencyLevel, $place) {
        $query = DB::table('internacoes')
                ->join('users', 'internacoes.u_id', '=', 'users.id')
                ->where(DB::raw('DATE_FORMAT(data_internacao,"%Y-%m-%d")'), '=', $date)
                ->when($place, function($query) use ($place) {
                    return $query->where('local_internacao', '=', $place);
                })
                ->when($urgencyLevel, function($query) use ($urgencyLevel) {
                    return $query->where('classificacao', '=', $urgencyLevel);
                })
                ->select('internacoes.i_id', DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")as dataInternacao'), 'internacoes.nome_paciente', 'internacoes.diagnostico', 'internacoes.medico_pa', 'internacoes.remocao', 'internacoes.nr_atendimento', 'internacoes.local_internacao', 'internacoes.Leito', 'internacoes.classificacao', 'internacoes.Especialidade', 'internacoes.medico_especialista', 'users.*')
                ->orderby('local_internacao')
                ->orderby('classificacao')
                ->get();
        return $query;
    }

    public static function spreadsheetMonth($month, $urgencyLevel, $place) {
        $query = DB::table('internacoes')
                ->join('users', 'internacoes.u_id', '=', 'users.id')
                ->where(DB::raw('DATE_FORMAT(internacoes.data_internacao, "%Y-%m")'), '=', $month)
                ->when($place, function($query) use ($place) {
                    return $query->where('local_internacao', '=', $place);
                })
                ->when($urgencyLevel, function($query) use ($urgencyLevel) {
                    return $query->where('classificacao', '=', $urgencyLevel);
                })
                ->select('internacoes.i_id', DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")as dataInternacao'), 'internacoes.nome_paciente', 'internacoes.diagnostico', 'internacoes.medico_pa', 'internacoes.remocao', 'internacoes.nr_atendimento', 'internacoes.local_internacao', 'internacoes.Leito', 'internacoes.classificacao', 'internacoes.Especialidade', 'internacoes.medico_especialista', 'users.*')
                ->orderby(DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")'))
                ->orderby('internacoes.local_internacao')        
                ->get();
        return $query;
    }

    public static function spreadsheetUrgencyLevel($urgencyLevel, $place) {
        $query = DB::table('internacoes')
                ->join('users', 'internacoes.u_id', '=', 'users.id')
                ->where('classificacao', '=', $urgencyLevel)
                ->when($place, function($query) use ($place) {
                    return $query->where('local_internacao', '=', $place);
                })
                ->select('internacoes.i_id', DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")as dataInternacao'), 'internacoes.nome_paciente', 'internacoes.diagnostico', 'internacoes.medico_pa', 'internacoes.remocao', 'internacoes.nr_atendimento', 'internacoes.local_internacao', 'internacoes.Leito', 'internacoes.classificacao', 'internacoes.Especialidade', 'internacoes.medico_especialista', 'users.*')
                ->orderby(DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")'), 'internacoes.local_internacao')
                ->get();
        return $query;
    }
    
    public static function spreadsheetPlace($place){
        $query = DB::table('internacoes')
                ->join('users', 'internacoes.u_id', '=', 'users.id')
                ->where('local_internacao', '=', $place)                
                ->select('internacoes.i_id', DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")as dataInternacao'), 'internacoes.nome_paciente', 'internacoes.diagnostico', 'internacoes.medico_pa', 'internacoes.remocao', 'internacoes.nr_atendimento', 'internacoes.local_internacao', 'internacoes.Leito', 'internacoes.classificacao', 'internacoes.Especialidade', 'internacoes.medico_especialista', 'users.*')
                ->orderby(DB::raw('DATE_FORMAT(internacoes.data_internacao, "%d/%m/%Y")'), 'internacoes.local_internacao')
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
        } else if ($date =="" && $month == "" && $urgencyLevel == ""){
            $query = Internacao::spreadsheetPlace($place);
            return $query;
        } else {
            $query = Internacao::spreadsheetUrgencyLevel($urgencyLevel, $place);
            return $query;
        }
    }

    public static function editarInternacoes($id) {
        $query = DB::table('internacoes')
                ->where('internacoes.i_id', '=', $id)
                ->get();

        return $query;
    }

    public static function updateInternacao($id, $nomePaciente, $diagnostico, $medicoPA, $remocao, $numeroAtendimento, $local, $outroLocal, $leito, $classificacao, $medicoEspecialista, $selEspecialidade) {
        if ($local == "Outros") {
            DB::table('internacoes')
                    ->join('users', 'internacoes.u_id', '=', 'users.id')
                    ->where('i_id', $id)
                    ->update(array('nome_paciente' => $nomePaciente, 'diagnostico' => $diagnostico, 'medico_pa' => $medicoPA, 'remocao' => $remocao, 'nr_atendimento' => $numeroAtendimento, 'local_internacao' => $outroLocal, 'Leito' => $leito, 'classificacao' => $classificacao, 'Especialidade' => $selEspecialidade, 'medico_especialista' => $medicoEspecialista));

            return "Sucesso";
        } else {
            DB::table('internacoes')
                    ->join('users', 'internacoes.u_id', '=', 'users.id')
                    ->where('i_id', $id)
                    ->update(array('nome_paciente' => $nomePaciente, 'diagnostico' => $diagnostico, 'medico_pa' => $medicoPA, 'remocao' => $remocao, 'nr_atendimento' => $numeroAtendimento, 'local_internacao' => $local, 'Leito' => $leito, 'classificacao' => $classificacao, 'Especialidade' => $selEspecialidade, 'medico_especialista' => $medicoEspecialista));

            return "Sucesso";
        }
    }

    public static function deleteInternacao($id) {
        DB::table('internacoes')
                ->join('users', 'internacoes.u_id', '=', 'users.id')
                ->where('i_id', $id)
                ->delete();
        return "Dados deletados com Sucesso";
    }

}
