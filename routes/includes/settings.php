<?php

use Illuminate\Support\Facades\Route;

Route::get('/settings', 'SettingsController@index');
Route::get('/settings/{id}', 'SettingsController@show');
Route::post('/settings/{id}', 'SettingsController@edit');
