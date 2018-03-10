<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>['AdminMiddleware']], function(){

	Route::get('/home', 'HomeController@index')->name('dashboard');
	route::get('/search','HomeController@search')->name('search');
	Route::resource('admin', 'Auth\AdminController');
	Route::get('admin/{id}/acount-edit-form','Auth\AdminController@accountEditForm')->name('acount.edit');
	Route::put('admin/{id}/acount-edit-form','Auth\AdminController@editOwnAccount')->name('acount.update');
	//DepertmentController
	Route::prefix('depertment')->group( function(){ 
		Route::get('/index', 'DepertmentController@index')->name('depertment');
		Route::post('/store', 'DepertmentController@store')->name('depertment.store');
		Route::get('/edit/{id}', 'DepertmentController@edit');
		Route::post('/update', 'DepertmentController@update')->name('depertment.update');
		Route::get('/delete/{id}', 'DepertmentController@destroy');
	});

	//PaymentController
	Route::prefix('paymentSystem')->group( function(){ 
		Route::get('/index', 'PaymentController@index')->name('paymentSystem');
		Route::post('/store', 'PaymentController@store')->name('paymentSystem.store');
		Route::get('/edit/{id}', 'PaymentController@edit')->name('paymentSystem.edit');
		Route::post('/update', 'PaymentController@update')->name('paymentSystem.update');
		Route::get('/delete/{id}', 'PaymentController@destroy')->name('paymentSystem.delete');

	});

	//WorkarControllar
	Route::prefix('worker')->group( function(){
		Route::get('/index', 'WorkarControllar@index')->name('worker.insert');
		Route::post('/store', 'WorkarControllar@store')->name('worker.store');
		Route::get('/show', 'WorkarControllar@show')->name('worker');
		Route::get('/edit/{id}', 'WorkarControllar@edit')->name('worker.edit');
		Route::post('/update', 'WorkarControllar@update')->name('worker.update');
		Route::get('/delete/{id}', 'WorkarControllar@destry')->name('worker.delete');
		
	});

	//SingelWorkerController
	Route::prefix('singel/worker')->group( function(){
		Route::get('/profile/{id}', 'SingelWorkerController@profile')->name('profile');
		Route::get('/attendes/{id}/{month}/{year}', 'SingelWorkerController@attendes')->name('attendes');
		Route::get('/payment/detils/{id}', 'SingelWorkerController@paymentDetails')->name('payment.history');		

	});

	Route::prefix('salary')->group(function(){
		Route::get('/show','SalaryController@show')->name('salarys');
		Route::get('/show/payment_type/{paymentTypeId}','SalaryController@paymentTypeByShow')->name('salarys.types');
		Route::post('payment','SalaryController@paymentStore')->name('payment.store');
	});

	Route::get('/view/attendance/form', 'AttendanceController@index')->name('attendance.form');
	Route::post('/attendes/save', 'AttendanceController@store');


});
