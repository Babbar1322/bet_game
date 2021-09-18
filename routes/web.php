<?php

use Illuminate\Support\Facades\Route;

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

Route::get("admin/login",'UserController@adminLogin')->name('admin.login');
Route::post("admin/postLogin",'UserController@postLogin')->name('adminLogin');
Route::middleware('auth')->group(function(){
Route::get("admin/dashboard",'UserController@dashboard')->name('admin.home')->middleware('is_admin');
Route::get('admin/users','UserController@getUsers')->name('admin.users');
Route::get('admin/editUser/{id}','UserController@editUser')->name('admin.editUser');
Route::get('admin/balancecut/{id}','UserController@balcut')->name('admin.balancecut');
Route::get('admin/balanceadd/{id}','UserController@baladd')->name('admin.balanceadd');
Route::post('admin/addBalance/{id}','UserController@addBalance')->name('admin.addBalance');
Route::post('admin/cutBalance/{id}','UserController@cutBalance')->name('admin.cutBalance');
Route::get('admin/levels','LevelController@index')->name('admin.level');
Route::get('admin/addLevel','LevelController@addLevel')->name('admin.addLevel');
Route::post('admin/storeLevel','LevelController@storeLevel')->name('admin.storeLevel');
Route::get('admin/editLevel/{id}','LevelController@editLevel')->name('admin.editLevel');
Route::post('admin/updateLevel/{id}','LevelController@updateLevel')->name('admin.updateLevel');
Route::get('admin/deleteLevel/{id}','LevelController@deleteLevel')->name('admin.deleteLevel');
Route::get("admin/userPayment","PaymentController@index")->name('admin.userPayment');
Route::post("admin/acceptPay","PaymentController@accept")->name('admin.accept');
Route::post("admin/rejectPay","PaymentController@reject")->name('admin.reject');
Route::get("admin/betRecords","GameController@getRecord")->name("admin.betRecords");
Route::get("admin/betRecord/{id}","GameController@getBet")->name("admin.recordDetails");
Route::get("admin/play","ResultController@playShow")->name("admin.playShow");
Route::post("admin/play","ResultController@play")->name("admin.play");
Route::get("admin/withdrawRequest","WithdrawController@wdRequest")->name("admin.wdRequest");
Route::get("admin/pendingReq","WithdrawController@pendingRequest")->name("admin.pendingReq");
Route::post("admin/acceptWd","WithdrawController@acceptWd")->name("admin.acceptWd");
Route::post("admin/rejectWd","WithdrawController@rejectWd")->name("admin.rejectWd");
Route::get("admin/transactions","WithdrawController@transactions")->name("admin.transactions");
Route::get("admin/leveltrans","WithdrawController@levelTrans")->name("admin.trans");
Route::get("admin/game_status","GameController@liveStatus")->name("admin.gameStatus");
Route::post("admin/winner","GameController@winner")->name("admin.winner");
Route::get("admin/settings","PaymentController@amountPers")->name('admin.amountPer');
Route::get("admin/addPer","PaymentController@addPer")->name('admin.addPer');
Route::get("admin/editPer/{id}","PaymentController@editPer")->name('admin.editPer');
Route::get("admin/deletePer/{id}","PaymentController@deletePer")->name('admin.deletePer');
Route::post("admin/storePer","PaymentController@storePer")->name('admin.storePer');
Route::post("admin/updatePer/{id}","PaymentController@updatePer")->name('admin.updatePer');

});
Route::post("/admin/logout",function(){
    Auth::logout();
    return redirect("admin/login");
})->name('logout');



Route::any('{slug}', function () {
    return view('welcome');
})->name('home');
Route::any('/{slug}/{name}', function () {
    return view('welcome');
});
Route::any('/{slug}/{slug1}/{name}', function () {
    return view('welcome');
});
Route::any('/{slug}/{slug1}/{slug2}/{name}', function () {
    return view('welcome');
});
