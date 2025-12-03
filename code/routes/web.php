<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\testController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/',  function() {
    return view('index');
});

Route::post('/searchOrder',  [OrderController::class, "search"] 
);

Route::get('/searchOrder',  [OrderController::class, "index"] 
);
