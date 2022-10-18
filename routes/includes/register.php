<?php
use Illuminate\Support\Facades\Route;

Route::get('/register', 'RegisterController@index');

Route::post('/register', 'RegisterController@register');
