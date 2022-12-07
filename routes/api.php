<?php

use App\Http\Controllers\PersonsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allpersons' ,[ PersonsController::class , 'index' ]);
Route::post('/createperson' ,[ PersonsController::class , 'store' ]);
Route::get('/searchPerson/{id_person}' ,[ PersonsController::class , 'edit' ]);
Route::put('/update_personByid/{id_person}' ,[ PersonsController::class , 'update' ]);
