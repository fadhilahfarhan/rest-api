<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\StudentController;
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

Route::get('/animals', [AnimalController::class, 'index']);

Route::post('/animals', [AnimalController::class, 'store']);

Route::put('/animals/{id}', [AnimalController::class, 'update']);

Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);

#get all resource students
#method get for show all data
Route::get('/students', [StudentController::class, 'index']);
#method post for add data
Route::post('/students', [StudentController::class, 'store']);
#method put for update data
Route::put('/students/{id}', [StudentController::class, 'update']);
#method delete for delete data
Route::delete('/students/{id}', [StudentController::class, 'destroy']);