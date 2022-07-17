<?php

use App\Http\Controllers\{LoginController, ManageTeamController, TeamController, TicketController, UserController};
use App\Models\Team;
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

Route::get('/login',[LoginController::class,'loginForm'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::controller(UserController::class)->group(function () {
    Route::get('/user/create','index')->name('create_user');
    Route::post('/user/create','store');
});

Route::middleware('auth')->group(function(){
    Route::controller(TicketController::class)->group(function () {
        Route::get('/','index')->name('ticket_list');
    });

    Route::controller(TeamController::class)->group(function() {
        Route::get('/teams','index')->name('team_list');
    });

    Route::middleware('admin')->group(function(){
        Route::get('/teams/manage',[ManageTeamController::class,'index'])->name('manage_team');

        Route::get('/teams/manage/create-user',[ManageTeamController::class,'createTeamUserForm'])->name('create_user_team');
        Route::post('/teams/manage/create-user',[UserController::class,'createTeamUser']);

        Route::get('/user/delete/{userId}',[UserController::class,'destroy'])->name('delete_user');

        Route::get('/user/{userId}',[UserController::class,'show'])->name('user.show');
        Route::post('/user/{userId}',[UserController::class,'update'])->name('user.update');
    
    });

});


