<?php

namespace Indicators\Http\Controllers\profile;

use Illuminate\Http\Request;
use Indicators\Http\Controllers\Controller;
use Indicators\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    public function profile() {
        $departments = Department::returnDepartments();
        return view('profile.profile', compact('departments'));
    }

    public function update() {
        $user = Auth::user();
        $rules = array(
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            if (!Hash::check(Input::get('old_password'), $user->password)) {
                return back()->with('status', 'Senha Atual Não Confere!');
            } else {
                $user->password = Hash::make(Input::get('password'));
                $user->save();
                return back()->with("status", "Senha Alterada com Sucesso");
            }
        }
    }

}
