<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\KlasemenController;
use App\Http\Controllers\TurnamenController;
use App\Http\Controllers\MyturnamenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\AdminTurnamenC;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::middleware(['guest'])->group(function () {
    Route::resource('/', LandingController::class);
    Route::get('/login', [AuthController::class, 'index'] )->name('auth');
    Route::post('/login', [AuthController::class, 'login'] );
    Route::get('/daftar', [AuthController::class, 'create'] )->name('daftar');
    Route::post('/daftar', [AuthController::class, 'daftar'] );
    Route::get('/verify/{verify_key}',[AuthController::class, 'verify']);
    Route::get('password/request', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('/home', '/user');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('UserAkses:admin');
    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('UserAkses:user');
    
    //Logout
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    //UserADMIN
    Route::get('/user_admin', [UserController::class, 'view'])->name('user.index')->middleware('UserAkses:admin');
    Route::get('/user_admin/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('UserAkses:admin');
    Route::delete('/user_admin/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('UserAkses:admin');
    Route::put('/use_admin/{id}', [UserController::class, 'update'])->name('user.update')->middleware('UserAkses:admin');

    //TurnamenAdmin
    Route::get('/turnamen_admin', [AdminTurnamenC::class, 'view'])->name('turnamen.view')->middleware('UserAkses:admin');
    Route::delete('/turnamen_admin/{id}', [AdminTurnamenC::class, 'destroy'])->name('turnamen.destroy')->middleware('UserAkses:admin');

    //Edit Profil
    Route::get('/profil', [AuthController::class, 'profil'])->name('profil.index')->middleware('UserAkses:user');
    Route::get('/profil/edit', [AuthController::class, 'edit_profil'])->name('profil.edit')->middleware('UserAkses:user');
    Route::put('/edit-profil', [AuthController::class, 'edit'])->name('profil.update')->middleware('UserAkses:user');

    //TimUser
    Route::post('/tim/store', [TimController::class, 'store'])->name('tim.store')->middleware('UserAkses:user');
    Route::get('/tim/{id_turnamenFK}/create', [TimController::class, 'create'])->name('tim.create')->middleware('UserAkses:user');
    Route::get('/tim/{id_turnamenFK}/{id}/edit', [TimController::class, 'edit'])->name('tim.edit')->middleware('UserAkses:user');
    Route::put('/tim/{id}', [TimController::class, 'update'])->name('tim.update')->middleware('UserAkses:user');
    Route::delete('/tim/{id}', [TimController::class, 'destroy'])->name('tim.destroy')->middleware('UserAkses:user');

    //ScheduleUser
    Route::post('/schedule/store', [ScheduleController::class, 'generateSchedule'])->name('schedule.generateSchedule')->middleware('UserAkses:user');
    Route::get('/schedule/{id_turnamenFK}/create', [ScheduleController::class, 'create'])->name('schedule.create')->middleware('UserAkses:user');
    Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit')->middleware('UserAkses:user');
    Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update')->middleware('UserAkses:user');

    //TurnamenUser
    Route::post('/turnamen', [TurnamenController::class, 'store'])->name('turnamen.store')->middleware('UserAkses:user');
    Route::get('/turnamen/create', [TurnamenController::class, 'create'])->name('turnamen.create')->middleware('UserAkses:user');

    Route::get('/mydetail_turnamen/{id}', [MyturnamenController::class, 'my_detail'])->name('myturnamen.detail');
    Route::get('/myturnamen', [MyturnamenController::class, 'index'])->name('myturnamen.index');
    Route::get('/myturnamen/{id}/edit', [MyturnamenController::class, 'edit'])->name('myturnamen.edit');
    Route::put('/myturnamen/{id}', [MyturnamenController::class, 'update'])->name('myturnamen.update');
    Route::delete('/myturnamen/{id}', [MyturnamenController::class, 'destroy'])->name('myturnamen.destroy');
});


Route::get('/team/{id_turnamenFK}', [TimController::class, 'team'])->name('tim.view');
Route::get('/schedules/{id_turnamenFK}', [ScheduleController::class, 'view'])->name('schedule.view');
Route::get('/standing/{id_turnamenFK}', [KlasemenController::class, 'view'])->name('klasemen.view');

Route::get('/tim/{id_turnamenFK}', [TimController::class, 'index'])->name('tim.index');
Route::get('/schedule/{id_turnamenFK}', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/klasemen/{id_turnamenFK}', [KlasemenController::class, 'index'])->name('klasemen.index');
Route::get('/turnamen', [TurnamenController::class, 'index'])->name('turnamen.index');
Route::get('/detail_turnamen/{id}', [TurnamenController::class, 'detail_turnamen'])->name('turnamen.detail');
Route::get('/panduan', [GuideController::class, 'index'])->name('guide.index');






