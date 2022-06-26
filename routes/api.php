<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TeamsController;
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

/* available routes
get teams (browser)
search teams (browser)
show team (browser)

register (leader)
login (leader)
logout (leader)
add a team (leader)
update the team (leader)
delete the team (leader)
*/

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/teams', [TeamsController::class, 'index']);
Route::get('/teams/{id}', [TeamsController::class, 'show']);
Route::get('/teams/search/{keyword}', [TeamsController::class, 'search']);

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/teams', [TeamsController::class, 'store']);
    Route::post('/teams/{id}/update', [TeamsController::class, 'update']); // not working yet
    Route::delete('/teams/{id}', [TeamsController::class, 'destroy']); // not working yet
    Route::delete('/teams/{id}/members', [MembersController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
