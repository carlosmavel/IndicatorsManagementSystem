<?php

namespace Indicators\Http\Controllers;

use Illuminate\Http\Request;

class IcuController extends Controller
{
    public function icuMain(){
        return view('icu.icuMain');
    }
    
    public function icuDataCollect() {
        return view('icu.icuDataCollect');
    }
    
    public function icuIndicators() {
        return view('icu.icuIndicators');
    }
}
