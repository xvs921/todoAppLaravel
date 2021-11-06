<?php

use Illuminate\Support\Facades\Route;
//LIST TASKS
Route::get('/', 'App\Http\Controllers\TasksController@index');
Route::get('/tasks', 'App\Http\Controllers\TasksController@index');
Route::get('/tasks/ready', 'App\Http\Controllers\TasksController@ready');
Route::get('/tasks/todo', 'App\Http\Controllers\TasksController@todo');
//NEW TASK PAGE AND SAVE
Route::get('/tasks/create', 'App\Http\Controllers\TasksController@newForm');
Route::post('/tasks', 'App\Http\Controllers\TasksController@saveNew');
//EDIT TASK PAGE AND SAVE
Route::get('/tasks/{id}', 'App\Http\Controllers\TasksController@editForm');
Route::patch('/tasks/edit/{id}', 'App\Http\Controllers\TasksController@edit');
//UPDATE COMPLETED
Route::patch('/tasks/{id}', 'App\Http\Controllers\TasksController@updateCompleted');
//DELETE TASK
Route::delete('/tasks/{id}', 'App\Http\Controllers\TasksController@delete');
