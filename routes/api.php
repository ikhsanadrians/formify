<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\QuestionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
});

Route::middleware('auth:sanctum')->group(function(){
      Route::post('logout',[AuthController::class,'logout']);

      Route::prefix('v1/forms')->group(function(){
          Route::post('/',[FormController::class,'store']);  
          Route::get('/',[FormController::class,'index']);   
          Route::get('/{slug}',[FormController::class,'show']);   
          
          Route::post('/{slug}/questions',[QuestionController::class,'store']);
          Route::delete('/{slug}/questions/{question_id}',[QuestionController::class,'destroy']);

      });
});