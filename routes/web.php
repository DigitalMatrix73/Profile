<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::controller(HomeController::class)
->group(function(){
    Route::get('/', 'index');
}); 
