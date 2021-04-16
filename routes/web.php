<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


  //user
  Route::get('/ipr/{id}/show', 'TodoController@show')->name('todo.show');
  Route::get('/ipr', 'TodoController@todos');
  Route::get('/ipr/create', 'TodoController@create')->name('todo.create');
  Route::post('/ipr/create', 'TodoController@store')->name('todo.store');
  Route::get('/ipr/{id}/edit', 'TodoController@edit')->name('todo.edit');
  Route::patch('/ipr/{id}/update', 'TodoController@update')->name('todo.update');
  Route::get('/ipr/{id}/file', 'TodoController@file')->name('todo.file');
  Route::get('/ipr/{id}/RejectedItems', 'TodoController@rejected')->name('todo.rejected');

  //SLO
  Route::get('/ipr/slo/kiambere', 'TodoController@kiambereSLO')->name('todo.kiambereSLO');
  Route::get('/ipr/slo/nyongoro', 'TodoController@nyongoroSLO')->name('todo.nyongoroSLO');
  Route::get('/ipr/slo/7Forks', 'TodoController@forksSLO')->name('todo.forksSLO');

  //SLM
  Route::get('/ipr/slm/kiambere', 'TodoController@kiambere')->name('todo.kiambere');
  Route::get('/ipr/slm/nyongoro', 'TodoController@nyongoro')->name('todo.nyongoro');
  Route::get('/ipr/slm/7forks', 'TodoController@forks')->name('todo.7forks');
  Route::get('/ipr/slm/sosoma', 'TodoController@sosoma')->name('todo.sosoma');
  Route::get('/ipr/slm/dokolo', 'TodoController@dokolo')->name('todo.dokolo');
  Route::patch('/ipr/{id}/updateSLM', 'TodoController@updateSLM')->name('todo.updateSLM');
  Route::get('/ipr/{id}/SiteReviewer', 'TodoController@showSLM')->name('todo.showSLM');

  //HOD
  Route::get('/ipr/{id}/showHOD', 'TodoController@showHOD')->name('todo.showHOD');
  Route::get('/ipr/HOD/IT', 'TodoController@it')->name('todo.it');
  Route::get('/ipr/HOD/HR', 'TodoController@hr')->name('todo.hr');
  Route::get('/ipr/HOD/Forestry', 'TodoController@forestry')->name('todo.forestry');
  Route::get('/ipr/HOD/Operations', 'TodoController@operation')->name('todo.operation');
  Route::get('/ipr/HOD/Miti', 'TodoController@miti')->name('todo.miti');
  Route::get('/ipr/HOD/Communications', 'TodoController@communication')->name('todo.communication');
  Route::get('/ipr/HOD/Accounts', 'TodoController@account')->name('todo.account');
  Route::get('/ipr/HOD/M&E', 'TodoController@ME')->name('todo.ME');
  Route::patch('/ipr/{id}/updateHOD', 'TodoController@updateHOD')->name('todo.updateHOD');

  //OP
  Route::get('/ipr/operations', 'TodoController@op')->name('todo.op');
  Route::patch('/ipr/{id}/updateOP', 'TodoController@updateOP')->name('todo.updateOP');
  Route::patch('/ipr/{id}/approve', 'TodoController@approve')->name('todo.approve');
  Route::get('/ipr/{id}/showOperations', 'TodoController@showOperation')->name('todo.showOperation');


  //MD
  Route::get('/ipr/AuthorizationDFO', 'TodoController@mdO')->name('todo.mdO');
  Route::get('/ipr/AuthorizationMD', 'TodoController@mdC')->name('todo.mdC');
  Route::get('/ipr/{id}/showAuthorization', 'TodoController@showMD')->name('todo.showMD');
  Route::patch('/ipr/{id}/updateMD', 'TodoController@updateMD')->name('todo.updateMD');

  //APPROVED
  Route::get('/ipr/ApprovedIPRs', 'TodoController@final')->name('todo.final');
  Route::get('/ipr/{id}/PrintIPR', 'TodoController@showFinal')->name('todo.showFinal');
  Route::get('/ipr/{id}/Attachments', 'TodoController@attachment')->name('todo.attachment');
  Route::patch('/ipr/{id}/complete', 'TodoController@complete')->name('todo.complete');
  Route::patch('/ipr/{id}/incomplete', 'TodoController@incomplete')->name('todo.incomplete');

  //SUPPLIER
  Route::get('/ipr/NewSupplier', 'TodoController@supplier')->name('todo.supplier');
  Route::get('/ipr/MySuppliers', 'TodoController@Mysuppliers')->name('todo.mysuppliers');
  Route::get('/ipr/UnapprovedSuppliers', 'TodoController@viewSupplier')->name('todo.viewSupplier');
  Route::post('/ipr/createSupplier', 'TodoController@storeSupplier')->name('todo.storeSupplier');
  Route::get('/ipr/viewSupplier', 'TodoController@viewSupplier')->name('todo.viewSupplier');
  Route::get('/ipr/ApprovedSuppliers', 'TodoController@approvedSupplier')->name('todo.approvedSupplier');
  Route::patch('/ipr/{id}/AuthorizeSupplier', 'TodoController@updateSupplier')->name('todo.updateSupplier');
  Route::patch('/ipr/{id}/RejectSupplier', 'TodoController@rejectSupplier')->name('todo.rejectSupplier');
  Route::patch('/ipr/{id}/AmendSupplier', 'TodoController@updateMySupplier')->name('todo.updateMySupplier');
  Route::get('/ipr/{id}/SupplierDetails', 'TodoController@showSupplier')->name('todo.showSupplier');
  Route::get('/ipr/{id}/MySupplierDetails', 'TodoController@showMySupplier')->name('todo.showMySupplier');
  Route::get('/ipr/{id}/PrintSupplier', 'TodoController@printSupplier')->name('todo.printSupplier');
  Route::get('/ipr/{id}/SupplierDocuments', 'TodoController@SupplierDoc')->name('todo.supplierdoc');

  //DASHBOARD
  Route::get('/Dashboard', 'TodoController@dash')->name('todo.dash');
  
  //TRACE
  Route::get('/ipr/Trace', 'TodoController@trace')->name('todo.trace');

  //ADMIN
  Route::get('/Users', 'TodoController@administrator')->name('todo.administrator');


Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/upload', 'UserController@uploadAvatar');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

