<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Models\Job;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::get('/applications', function () {
    return view('appliedJobs');
})->name('applications');


// Route::get('/jobs', function () {
//     return view('jobsApplicant', [JobsController::class, 'available']);
// })->name('jobs');

Route::get('/jobs', [JobsController::class, 'available'])->name('jobs');
Route::get('/manageJobs', function () {
    return view('manageJobs', [
        'jobs' => Job::all()
    ]);
})->name('manageJobs');
Route::post('/apply/{job}', [JobsController::class, 'apply']);
Route::post('/addJob', [JobsController::class, 'create'])->name('addJob');
Route::post('/editJob/{job}', [JobsController::class, 'edit'])->name('editJob');
Route::post('/deleteJob/{job}', [JobsController::class, 'delete'])->name('deleteJob');
Route::post('/closeJob/{job}', [JobsController::class, 'close'])->name('closeJob');
Route::get('/applicants-{job}', [JobsController::class, 'applicants'])->name('applicants');
Route::post('/rank-{job}', [JobsController::class, 'rank'])->name('rank');
Route::post('/addProfile', [UserController::class, 'create']);
Route::post('/editProfile', [UserController::class, 'edit']);
Route::get('/try', function () {
    return 'hello';
});

require __DIR__ . '/auth.php';
