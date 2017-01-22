<?php

namespace Indicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Department extends Model {

    public function roles() {
        return $this->belongsToMany(\Indicators\Role::class);
    }
    
    /* public static function returnDepartments(){

      foreach (auth()->user()->roles as $role){

      $departments = $role->departments;

      foreach ($departments as $dept){
      $depto = $dept->get();
      }
      }
      return $depto;
      } */

    public static function returnDepartments() {
        $user_id = Auth::user()->id;
        $query = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                ->join('department_role', 'roles.id', '=', 'department_role.role_id')
                ->join('departments', 'department_role.department_id', '=', 'departments.id')
                ->where('users.id', '=', $user_id)
                ->select('departments.name', 'departments.route', 'departments.icon')
                ->orderBy('departments.name')
                ->get();

        return $query;
    }

}
