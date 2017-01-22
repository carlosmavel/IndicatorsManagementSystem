<?php

namespace Indicators;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles() {
        return $this->belongsToMany(\Indicators\Role::class);
    }
}
