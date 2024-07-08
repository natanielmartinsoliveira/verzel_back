<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/migration', function () {
    return Artisan::call('migrate', ["--force" => true ]);
});

/*Route::get('/', function () {
    return view('welcome');
});
*/
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
