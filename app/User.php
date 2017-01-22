<?php

namespace Indicators;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Indicators\Department;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function roles(){
        return $this->belongsToMany(\Indicators\Role::class);
    }
    
    public function departments(){
        return $this->belongsToMany(\Indicators\Department::class);
    }
    
    public function appraisals() {
        return $this->hasOne(\Indicators\appraisal\Appraisal::class);
    } 


    public function hasDepartment(Department $department){
        return $this->hasAnyDepartment($department->roles);
    }
    
    public function hasAnyDepartment($roles){
        if(is_array($roles) || is_object($roles)){
            return !! $roles->intersect($this->roles)->count();            
        }
        return $this->roles()->contains('name', $roles);
    }    
            
}
