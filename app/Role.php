<?php

namespace Indicators;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function departments(){
        return $this->belongsToMany(\Indicators\Department::class);
    }
}
