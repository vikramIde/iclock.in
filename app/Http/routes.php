<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');


});
Route::get('targetmodule', function () {
    return view('targetmodule/targetlogin');


});


Route::controllers([
	'auth'=>'Auth\AuthController',
	'password'=>'Auth\PasswordController',
]);

//POST route
Route::post('home', 'LoginController@postLogin');

Route::controller('event', 'EventController');
Route::controller('update', 'EventController');
Route::controller('delete', 'EventController');
Route::controller('delevent', 'EventController');
Route::controller('eventupdate', 'EventController');
Route::controller('invoice', 'EventController');
Route::controller('home1', 'EventController');
Route::controller('updateemployee','EventController');
Route::controller('home2', 'ViewController');
Route::controller('dealsclosed', 'DealsclosedController');

Route::controller('test', 'EventController');
Route::controller('pdfgenerate', 'EventController');

Route::controller('approveinvoice','ViewController');
Route::controller('rejectinvoice','ViewController');
Route::controller('updateinvoice','EventController');
Route::controller('invoice_edit','EditinvoiceController');
Route::controller('editinvoice','EditinvoiceController');
Route::controller('viewinvoice/{order_id}','ViewinvoiceController');
Route::controller('createinvoice/{deal_id}','CreateinvoiceController');

//target module

Route::controller('targetmodule/targetlogin','TargetloginController');
Route::controller('targetmodule/adduser', 'AddUserController');
Route::controller('user', 'AddUserController');
Route::controller('targetmodule/targethome','TargetController');
Route::controller('targetmodule/admin','AdminController');
Route::controller('targetmodule/assigntarget','AssigntargetController');
Route::controller('targetmodule/eventdeal','EventdealController');
Route::controller('addemployee','TargetController');
Route::controller('dealinsert','EventdealController');
Route::controller('targetassign','AssigntargetController');
Route::controller('updatetargetassign','AssigntargetController');
Route::controller('updateadmin','AdminController');
// Route::post('variancecard','TargetController@variancecard');
Route::controller('updateadmin','AdminController');

Route::get('targetmodule/variancecard','TargetController@getVariancecard');

Route::post('targetmodule/variancecard','TargetController@postVariancecard');
Route::get('resetpass','AddUserController@getResetpass');
Route::post('/reset','AddUserController@postReset');


Route::get('targetmodule/logout',function(){
	Session::flush();
	Auth::logout();
	return Redirect::to('targetmodule');
});

Route::controller('collection','CollectionController');

//Route::get('collection','CollectionController@getIndex');

// Route::get('collection', function () {
//     return view('login');
// });

Route::get('main/logout',function(){
	Session::flush();
	Auth::logout();
	session()->flash('alert-success', 'Success logged out');
	return Redirect::to('/');
});
