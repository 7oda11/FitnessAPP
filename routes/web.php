<?php

use App\Http\Controllers\Auth\AdministratorAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TrainerAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('trainer/register', [App\Http\Controllers\Auth\TrainerAuthController::class, 'showRegistrationForm'])->name('trainer.register');
Route::post('trainer/store', [App\Http\Controllers\Auth\TrainerAuthController::class, 'register'])->name('Trainer.register');
Route::get('trainer/login', [App\Http\Controllers\Auth\TrainerAuthController::class, 'showLoginForm'])->name('trainer.login');
Route::post('trainer/login', [App\Http\Controllers\Auth\TrainerAuthController::class, 'login']);
Route::post('trainer/logout', [App\Http\Controllers\Auth\TrainerAuthController::class, 'logout'])->name('trainer.logout');

// Protect trainer routes with auth.trainer middleware
Route::group(['middleware' => ['auth.trainer']], function () {
    Route::get('/trainer/dashboard', [App\Http\Controllers\TrainerController::class, 'dashboard'])->name('trainer.dashboard');
    Route::get('/trainer/profile', [App\Http\Controllers\TrainerController::class, 'profile'])->name('trainer.profile');
    Route::get('/trainer/profile/show', [App\Http\Controllers\TrainerController::class, 'showProfile'])->name('trainer.showProfile');
    Route::post('/trainer/update', [TrainerController::class, 'update'])->name('trainer.update');
    Route::get('/trainer/exercises', [App\Http\Controllers\TrainerController::class, 'showExerciseForm'])->name('trainer.showExerciseForm');
    Route::post('/trainer/storeExercises', [TrainerController::class, 'exercises'])->name('trainer.exercises');
    Route::get('/trainer/showExercises/{id}', [App\Http\Controllers\TrainerController::class, 'showExercises'])->name('trainer.showExercises');
    Route::get('/trainer/showEditExercises/{id}', [App\Http\Controllers\TrainerController::class, 'showEditExercises'])->name('trainer.showEditExercises');
    Route::post('/trainer/editExercises/{id}', [TrainerController::class, 'editExercises'])->name('trainer.editExercises');
    Route::get('/trainer/deleteExercises/{id}', [TrainerController::class, 'deleteExercises'])->name('trainer.deleteExercises');

    Route::get('/trainer/workouts', [App\Http\Controllers\TrainerController::class, 'workouts'])->name('trainer.workouts');
    Route::get('/trainer/meeting', [App\Http\Controllers\TrainerController::class, 'meeting'])->name('trainer.meeting');
    Route::get('/trainer/form_create_meeting', [App\Http\Controllers\TrainerController::class, 'formCreateMeeting'])->name('trainer.formCreateMeeting');
    Route::post('/trainer/meeting/create', [App\Http\Controllers\TrainerController::class, 'createMeeting'])->name('trainer.createMeeting');
    Route::get('/trainer/meeting/show/{id}', [App\Http\Controllers\TrainerController::class, 'showMeeting'])->name('trainer.showMeeting');
    Route::get('/trainer/meeting/show/edit/{id}', [App\Http\Controllers\TrainerController::class, 'showEditMeeting'])->name('trainer.showEditMeeting');
    Route::post('/trainer/meeting/show/update/{id}', [App\Http\Controllers\TrainerController::class, 'editMeeting'])->name('trainer.editMeeting');
    Route::get('/trainer/meeting/delete/{id}', [App\Http\Controllers\TrainerController::class, 'deleteMeeting'])->name('trainer.deleteMeeting');

    Route::get('/trainer/chatbot', [App\Http\Controllers\TrainerController::class, 'chatbot'])->name('trainer.chatbot');
    Route::get('/trainer/logout/show', [App\Http\Controllers\TrainerController::class, 'logoutShow'])->name('trainer.logoutShow');




    // Other trainer routes...
});

// Administrator Authentication
Route::get('administrator/register', [App\Http\Controllers\Auth\AdministratorAuthController::class, 'showRegistrationForm'])->name('administrator.register');
Route::post('administrator/register', [App\Http\Controllers\Auth\AdministratorAuthController::class, 'register']);
Route::get('administrator/loginLoading', [AdministratorAuthController::class, 'loginLoading'])->name('loginLoading');
Route::get('administrator/login', [App\Http\Controllers\Auth\AdministratorAuthController::class, 'showLoginForm'])->name('administrator.login');
Route::post('administrator/login', [App\Http\Controllers\Auth\AdministratorAuthController::class, 'login']);
Route::post('administrator/logout', [App\Http\Controllers\Auth\AdministratorAuthController::class, 'logout'])->name('administrator.logout');

// Protect administrator routes with auth.administrator middleware
Route::group(['middleware' => ['auth.administrator']], function () {
    Route::get('/administrator/dashboard', [App\Http\Controllers\AdministratorController::class, 'dashboard'])->name('administrator.dashboard');
    Route::get('/administrator/profile', [App\Http\Controllers\AdministratorController::class, 'profile'])->name('administrator.profile');
    Route::get('/administrator/workouts', [App\Http\Controllers\AdministratorController::class, 'workouts'])->name('administrator.workouts');
    Route::get('/administrator/meeting', [App\Http\Controllers\AdministratorController::class, 'meeting'])->name('administrator.meeting');
    Route::get('/administrator/exercise', [App\Http\Controllers\AdministratorController::class, 'exercise'])->name('administrator.exercise');
    Route::post('/administrator/exercise/store', [App\Http\Controllers\AdministratorController::class, 'exercisestore'])->name('administrator.exercisestore');
    Route::get('/administrator/logout/show', [App\Http\Controllers\AdministratorController::class, 'logoutShow'])->name('administrator.logoutShow');






    // Other administrator routes...
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/registerLoading', [UserController::class, 'regiserLoading'])->name('registerLoading');

Route::group(['middleware' => ['auth.user']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/profile/show', [UserController::class, 'showProfile'])->name('user.showProfile');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/workouts', [UserController::class, 'workouts'])->name('user.workouts');
    Route::get('/user/getAllExercises/{id}', [App\Http\Controllers\UserController::class, 'getAllExercises'])->name('user.getAllExercises');

    Route::get('/user/meeting', [UserController::class, 'meeting'])->name('user.meeting');
    Route::get('/user/meeting/show/{id}', [App\Http\Controllers\UserController::class, 'showMeeting'])->name('user.showMeeting');
    Route::get('/user/meeting/assign/{id}', [App\Http\Controllers\UserController::class, 'assignMeeting'])->name('user.assignMeeting');
    Route::get('/user/meeting/scheduled', [App\Http\Controllers\UserController::class, 'scheduled'])->name('user.scheduled');
    Route::get('/user/meeting/unscheduled/{id}', [App\Http\Controllers\UserController::class, 'unscheduled'])->name('user.unscheduled');
    Route::get('/user/trainer', [UserController::class, 'Trainers'])->name('user.trainers');
    Route::get('/user/trainer/show/{id}', [UserController::class, 'showtriner'])->name('user.showtriner');
    Route::get('/user/trainer/register/{id}', [UserController::class, 'registertriner'])->name('user.registertriner');
    Route::get('/user/trainer/register', [UserController::class, 'registertriners'])->name('user.registertriners');
    Route::get('/user/trainer/register/show/{id}', [UserController::class, 'showRegistertriner'])->name('user.showRegistertriner');
    Route::get('/user/trainer/register/show/{id}', [UserController::class, 'showRegistertriner'])->name('user.showRegistertriner');
    Route::get('/user/trainer/unregistertriner/{id}', [UserController::class, 'unregistertriner'])->name('user.unregistertriner');

    Route::get('/user/chatbot', [UserController::class, 'chatbot'])->name('user.chatbot');
    Route::get('/user/logout/show', [UserController::class, 'logoutShow'])->name('user.logoutShow');
});
Auth::routes();
