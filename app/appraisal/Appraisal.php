<?php

namespace Indicators\appraisal;

use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    
    public function user() {
        return $this->belongsTo(\Indicators\User::class);
    }
    
    
    public function notes() {
        return $this->belongsToMany(\Indicators\user\notes\Notes::class);
    }    
    
}
