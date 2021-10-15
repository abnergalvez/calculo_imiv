<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\FuncionesCalculos;
use App\Models\Customer;
use App\Models\Project;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/projectCodeCreate',function (Request $request){
	
    if(!empty($request->customer_id)){

        $prefix = Customer::find($request->customer_id)->prefix;
        $max_code_number = Project::where('customer_id', $request->customer_id)->max('code_number'); 
        
        $max = $max_code_number+1;

        if(empty($max_code_number)){
            $code = $prefix.'1';
            $max_code_number = 1;
        }else{
            $code = $prefix.strval($max);
            $max_code_number = $max;
        }

    }else{

        $code = '';
        $max_code_number = null;
    }

    return $resp = [
        'code'=> $code,
        'max_code_number'=> $max_code_number,
    ];
    
});


Route::post('/projectCodeUpdate',function (Request $request){
	
    $project = Project::find($request->project_id);

    if(!empty($request->customer_id)){

        if($project->customer_id != $request->customer_id){
            $prefix = Customer::find($request->customer_id)->prefix;
            $max_code_number = Project::where('customer_id', $request->customer_id)->max('code_number'); 
            $max = $max_code_number+1;
            if(empty($max_code_number)){
                $code = $prefix.'1';
                $max_code_number = 1;
            }else{
                $code = $prefix.strval($max);
                $max_code_number = $max;
            }
        }else{

            $code = $project->code;
            $max_code_number = $project->code_number;
        }


    }else{

        $code = '';
        $max_code_number = '';
    }

    return $resp = [
        'code'=> $code,
        'max_code_number'=> $max_code_number,
    ];
    
});