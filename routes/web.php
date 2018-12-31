<?php

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
Route::get('/', 'ProjectsController@home')->name('home');
Route::get('/projects', 'ProjectsController@projectView')->name('projects');
Route::get('/projects/{project}', 'TasksController@index');
Route::get('/projects/{project}/showAll', 'TasksController@showAll');
Route::get('/date/{date}', 'TasksController@tasksByDate');
Route::get('/projects/tomorrow', 'TasksController@tasksTomorrow');
Route::post('/projects/add', 'ProjectsController@add');
Route::delete('/projects/delete/{project}', 'ProjectsController@delete');


    //Route::get('/', 'Crud5Controller@index');
    Route::match(['get', 'post'], '/projects/{project}/create', 'TasksController@create');
    
    Route::match(['get', 'put'], '/update/{id}', 'TasksController@update');
    Route::delete('/delete/{task}', 'TasksController@delete');
    Route::get('/show/{id}', 'TasksController@show');
    Route::get('/toggleStatus/{id}/{completed}', 'TasksController@toggleTaskStatus');
    



Auth::routes();

Route::get('/home', 'HomeController@index');
