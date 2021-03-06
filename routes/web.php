<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();
Auth::routes(['register' => false]);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@home')->name('dashboard');
Route::get('/inicio', 'HomeController@index')->name('inicio');
Route::post('/calcular', 'CalculoController@calculo')->name('calculo_otros');
Route::post('/calcular_deptos', 'CalculoDepartamentosController@calculo')->name('calculo_deptos');
Route::post('/calcular_casas', 'CalculoCasasController@calculo')->name('calculo_casas');
Route::post('/guardar_mixto', 'CalculoMixtoController@guardar')->name('mixto_guardar');
Route::get('/calcular_mixto', 'CalculoMixtoController@calcular')->name('mixto_calcular');
Route::get('/borrar_mixto', 'CalculoMixtoController@borrar')->name('mixto_borrar');
Route::post('/enviar_resultados', 'EmailController@enviarResultados')->name('resultados_por_email');
Route::get('/calculo_cesion', 'CalculoCesionController@index')->name('inicio.cesion');
Route::post('/resultado_cesion', 'CalculoCesionController@calculo')->name('calculo.cesion');

Route::get('/detalle_proyecto/{code}', 'HomeController@detailProject')->name('detail_project.customer');

Route::get('/salir', function(){
    auth()->logout();
    return redirect('/');
})->name('salir');


/**  DASHBOARD  **/

/*
|--------------------------------------------------------------------------
|  Admin 
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'namespace' => 'Dashboard\Admin',
        'prefix' => 'admin',
        'middleware' =>['auth','admin']
    ]
    ,function () { 
        
        Route::group(['prefix' => 'mantenedores'], function(){
            
            Route::resource('usuarios', 'UserController')->names('admin.users')->middleware('super'); 
            Route::resource('clientes', 'CustomerController')->names('admin.customers'); 
            Route::resource('tipos_proyectos', 'TypeProjectController')->names('admin.type_projects'); 
            Route::resource('revisores', 'ReviserController')->names('admin.revisers'); 
            Route::get('feriados', 'HolidayController@index')->name('admin.holidays.index'); 
            Route::get('generar_feriados', 'HolidayController@setHolidays')->name('admin.holidays.set'); 
            

        });
        Route::resource('proyectos', 'ProjectController')->names('admin.projects'); 
        Route::get('reingresos_proyectos_por_vencer', 'ProjectController@soonExpire')->name('admin.projects.soonExpire'); 
        Route::get('reingresos_proyectos_vencidos', 'ProjectController@expired')->name('admin.projects.expired'); 
        Route::get('observaciones_proyectos_por_vencer', 'ProjectController@soonObservationExpire')->name('admin.projects.soonObservationExpire'); 
        Route::get('estado_final_proyectos_por_vencer', 'ProjectController@finalStatusSoonExpire')->name('admin.projects.finalStatusSoonExpire');

        Route::get('proyectos/{proyecto}/cambio_estado', 'ProjectController@editStatus')->name('admin.projects.editStatus'); 
        Route::put('proyectos/{proyecto}/cambio_estado', 'ProjectController@updateStatus')->name('admin.projects.updateStatus');
        Route::get('proyectos/{proyecto}/reingreso', 'ProjectController@editReEntry')->name('admin.projects.editReEntry'); 
        Route::put('proyectos/{proyecto}/reingreso', 'ProjectController@updateReEntry')->name('admin.projects.updateReEntry');

        Route::resource('proyectos/{proyecto}/facturas', 'InvoiceController')->names('admin.projects.invoices')->middleware('super'); 
        Route::get('proyectos/{proyecto}/facturas/{factura}/cambio_estado', 'InvoiceController@editStatus')->name('admin.projects.invoices.editStatus')->middleware('super'); 
        Route::put('proyectos/{proyecto}/facturas/{factura}/cambio_estado', 'InvoiceController@updateStatus')->name('admin.projects.invoices.updateStatus')->middleware('super'); 

        Route::get('home', 'ProfileController@index')->name('admin.home'); 
        Route::get('perfil', 'ProfileController@profile')->name('admin.profile');
        Route::put('perfil', 'ProfileController@update')->name('admin.profile.update'); 
        
        Route::resource('presupuestos', 'BudgetController')->names('admin.budgets')->middleware('super'); 
        Route::get('ingresos_presupuestos_por_vencer', 'BudgetController@soonExpire')->name('admin.budgets.soonExpire')->middleware('super'); 
        Route::get('ingresos_presupuestos_vencidos', 'BudgetController@expired')->name('admin.budgets.expired')->middleware('super'); 

        Route::get('presupuestos/{presupuesto}/cambio_estado', 'BudgetController@editStatus')->name('admin.budgets.editStatus')->middleware('super'); 
        Route::put('presupuestos/{presupuesto}/cambio_estado', 'BudgetController@updateStatus')->name('admin.budgets.updateStatus')->middleware('super'); 



});
/*
|--------------------------------------------------------------------------
|  Normal 
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'namespace' => 'Dashboard\Normal',
        'prefix' => 'user',
        'middleware' =>['auth','normal']
    ]
    ,function () { 
           
        Route::get('home', 'ProfileController@index')->name('normal.home'); 
});