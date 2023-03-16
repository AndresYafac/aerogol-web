<?php

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); //{{route('home')}}

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
//Deportes
Route::get('/deportes', 'DeportesController@index');
Route::get('/deportes/create', 'DeportesController@create');//form registro
Route::get('/deportes/{deporte}/edit', 'DeportesController@edit');

Route::post('/deportes', 'DeportesController@store');//envio del form
Route::put('/deportes/{deporte}', 'DeportesController@update');
Route::delete('/deportes/{deporte}', 'DeportesController@destroy');

//Canchas
Route::resource('courts','CanchaController');

//Clientes
Route::resource('clients','ClientController');

//charts
Route::get('/charts/appointments/line', 'ChartController@appointments');
Route::get('/charts/courts/column', 'ChartController@courts');
Route::get('/charts/courts/column/data', 'ChartController@courtsJson');
});

Route::middleware(['auth', 'empleado'])->namespace('Courts')->group(function () {
    Route::get('/schedule', 'ScheduleController@edit');
    Route::post('/schedule', 'ScheduleController@store');
});

Route::middleware('auth')->group(function (){
    Route::get('/appointments/create', 'AppointmentController@create');
    Route::post('/appointments', 'AppointmentController@store');



    Route::get('/appointments', 'AppointmentController@index');
    Route::get('/appointments/{appointment}/', 'AppointmentController@show');

    Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
    Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

    Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');


    //JSON  
    Route::get('/deportes/{deporte}/courts', 'Api\DeporteController@courts');
    Route::get('/schedule/hours', 'Api\ScheduleController@hours');
});




