<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Models\Project;
use Inertia\Inertia;
use App\Models\Skill;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::resource('skills', SkillController::class)
    ->except(['create', 'show', 'edit']);
Route::resource('projects', ProjectController::class)
    ->except(['create', 'show', 'edit']);
