<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('/forms/login');
});



// Route::get('/register', 'AuthController@index');
