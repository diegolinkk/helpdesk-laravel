<?php

use App\Http\Controllers\{CategoryController, LoginController, ManageTeamController, TeamController, TicketController, UserController,TicketTypeController};
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
    Route::get('/',function(){ 
        return redirect()->route('ticket_list');
    });

    Route::controller(TicketController::class)->group(function () {
        Route::get('/ticket','index')->name('ticket_list');
        Route::get('/ticket/create','formCreate')->name('ticket_create');
        Route::post('/ticket/create','create');
        Route::get('/ticket/{ticketId}/','show')->name('ticket.show');
        Route::post('/ticket/{ticketId}/','update');
    });

    Route::controller(TicketTypeController::class)->group(function(){
        Route::get('/ticket-type','storeForm')->name('ticketType.store');
        Route::post('/ticket-type','store');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category','storeForm')->name('category.store');
        Route::post('/category','store'); 
    });

    Route::middleware('admin')->group(function(){
        Route::get('/teams/manage',[ManageTeamController::class,'index'])->name('manage_team');

        Route::get('/teams/manage/create-user',[ManageTeamController::class,'createTeamUserForm'])->name('create_user_team');
        Route::post('/teams/manage/create-user',[UserController::class,'createTeamUser']);

        Route::get('/user/delete/{userId}',[UserController::class,'destroy'])->name('delete_user');

        Route::get('/user/{userId}',[UserController::class,'show'])->name('user.show');
        Route::post('/user/{userId}',[UserController::class,'update'])->name('user.update');

        Route::get('/user/update-password/{userId}',[UserController::class,'updatePasswordForm'])->name('user.update_password');
        Route::post('/user/update-password/{userId}',[UserController::class,'updatePassword']);
    
    });

});


