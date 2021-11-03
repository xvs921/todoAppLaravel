<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\TasksController@index');
Route::get('/tasks', 'App\Http\Controllers\TasksController@index');
Route::get('/tasks/create', 'App\Http\Controllers\TasksController@create');
Route::get('/tasks', 'App\Http\Controllers\TasksController@store');
