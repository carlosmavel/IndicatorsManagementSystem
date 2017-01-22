<?php

namespace Indicators\Http\Controllers\management;

use Illuminate\Http\Request;
use Indicators\Http\Controllers\Controller;

class ManagementController extends Controller
{
    public function managementMain() {
        return view('management.managementMain');
    }
}
