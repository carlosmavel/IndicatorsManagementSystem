<?php

namespace Indicators\user\notes;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    public function appraisal(){
        return $this->belongsTo(\Indicators\appraisal\Appraisal::class);
    }
}
