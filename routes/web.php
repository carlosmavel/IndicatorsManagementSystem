<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

Route::get('/', function () {    
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index');


//pa routes

Route::get('/paDataCollect', 'pa\PaController@paDataCollect');

Route::post('/paDataCollect', 'pa\PaController@admissionProcess');

Route::get('/paTable', 'pa\PaController@paTable');

Route::post('/paTable', 'pa\PaController@tableProcess');

Route::get('/internacoesAlterar', 'pa\PaController@internacoesEditar');

Route::post('/internacoesAlterar', 'pa\PaController@internacoesAtualizar');

Route::get('/internacoesExcluir', 'pa\PaController@internacoesExcluir');

Route::get('/paIndicators', 'pa\PaController@paIndicators');
    
    //autocomplete route
Route::any('selectDoctors', function() {
    $term = Str::lower(Input::get('term'));

    $data = DB::table('doctors')->select('doctor_name')->where('doctor_name', 'like', '%' . $term . '%')->groupBy('doctor_name')->take(10)->get();

        foreach ($data as $v) {
            $return_array[] = array('value' => $v->doctor_name);
        }
    return Response::json($return_array);
});
    //end autocomplete route

//end pa routes


//icu routes

Route::get('/icuMain', 'icu\IcuController@icuMain');

Route::get('/icuDataCollect', 'icu\IcuController@icuDataCollect');

Route::get('/icuIndicators', 'icu\IcuController@icuIndicators');

Route::post('/icuInsertData', 'icu\IcuController@icuInsertData');

Route::get('/icuTable', 'icu\IcuController@returnIcuTable');

Route::post('/icuTableFilter', 'icu\IcuController@returnIcuTableFilter');

Route::get('/icuEdit', 'icu\IcuController@returnDataEdit');

Route::post('/icuEdit', 'icu\IcuController@dataUpdate');

Route::get('/icuDelete', 'icu\IcuController@dataDelete');


//end icu


//nicu routes

Route::get('/nicuMain', 'nicu\NicuController@nicuMain');

Route::get('/nicuDataCollect', 'nicu\NicuController@nicuDataCollect');

Route::get('/nicuIndicators', 'nicu\NicuController@nicuIndicators');

Route::post('/nicuInsertData', 'nicu\NicuController@nicuInsertData');

Route::get('/nicuTable', 'nicu\NicuController@returnNicuTable');

Route::post('/nicuTableFilter', 'nicu\NicuController@returnNicuTableFilter');

Route::get('/nicuEdit', 'nicu\NicuController@returnDataEdit');

Route::post('/nicuEdit', 'nicu\NicuController@dataUpdate');

Route::get('/nicuDelete', 'nicu\NicuController@dataDelete');


//end nicu


//Management routes

Route::get('/managementMain', 'management\ManagementController@managementMain');


//end Management routes


//Profile routes

Route::get('/profile', 'profile\ProfileController@profile');

Route::post('/update', 'profile\ProfileController@update');

//end Profile routes




//test functions and anything new
//Route::get('/test', 'teste\TesteController@teste');

Route::get('/test', 'teste\TesteController@testeDataCollect');

Route::post('/testInsert', 'teste\TesteController@admissionProcess');

/*Route::get('/paTable', 'pa\PaController@paTable');

Route::post('/paTable', 'pa\PaController@tableProcess');

Route::get('/internacoesAlterar', 'pa\PaController@internacoesEditar');

Route::post('/internacoesAlterar', 'pa\PaController@internacoesAtualizar');

Route::get('/internacoesExcluir', 'pa\PaController@internacoesExcluir');

Route::get('/paIndicators', 'pa\PaController@paIndicators');*/