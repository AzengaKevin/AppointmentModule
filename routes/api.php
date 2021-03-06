<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth:api']], function () {
    
    Route::resource('employees', 'EmployeeController')
        ->except('create', 'edit');
    
    Route::resource('tasks', 'TaskController')
        ->except('create', 'edit');
    
    Route::resource('employees.tasks', 'EmployeeTaskController');

});
    
Route::post('login', 'UserController@login')->name('login');

