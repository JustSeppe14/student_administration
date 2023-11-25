<?php

use App\Livewire\CoursesOverview;
use App\Models\programme;
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

Route::view("/",'home')->name('home');
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','/programme');
    Route::get('programme', CoursesOverview::class)->name('programme');
});
Route::middleware(['auth','active'])->prefix('admin')->name('admin.')->group(function (){
    Route::redirect('/','admin/course');
    Route::get('course', CoursesOverview::class)->name('course');
});

Route::middleware(['guest'])->group(function (){
    Route::redirect('/','/course');
    Route::get('course', CoursesOverview::class)->name('course');
});


Route::view('under-construction','under-construction')->name('under-construction');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'active',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
