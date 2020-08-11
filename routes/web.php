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

Auth::routes(['reset' => false, 'confirm' => false, 'verify' => false]);


Route::group(['middleware' => ['auth']], function (){

    Route::get('/', 'HomeController@index')->name('home');

    // Cabinet
    Route::group(['prefix' => 'cabinet', 'as' => 'cabinet.',  'namespace' => 'Cabinet'], function () {

        Route::group(['prefix' => 'vacations', 'as' => 'vacations.', 'namespace' => 'Vacation'], function () {
            Route::get('/', 'VacationsController@index')->name('home');
            Route::get('/{vacation}/show', 'VacationsController@show')->name('show');
            Route::get('/create', 'VacationsController@createForm')->name('create');
            Route::post('/create', 'VacationsController@create');
            Route::get('/{vacation}/edit', 'VacationsController@editForm')->name('edit');
            Route::put('/{vacation}/edit', 'VacationsController@edit');
            Route::delete('/{vacation}/edit', 'VacationsController@destroy')->name('delete');
        });
    });

    // Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['can:director']], function () {

        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'vacations', 'as' => 'vacations.', 'namespace' => 'Vacation'], function () {
            Route::get('/', 'VacationsController@index')->name('home');
            Route::get('/{vacation}/show', 'VacationsController@show')->name('show');
            Route::get('/{vacation}/edit', 'VacationsController@editForm')->name('edit');
            Route::put('/{vacation}/edit', 'VacationsController@edit');

            Route::post('/{vacation}/status-wait', 'VacationsController@statusNoCompleted')->name('status.wait');
            Route::post('/{vacation}/status-completed', 'VacationsController@statusCompleted')->name('status.completed');

            Route::delete('/{vacation}/edit', 'VacationsController@destroy')->name('delete');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.', 'namespace' => 'User'], function () {
            Route::get('/', 'UsersController@index')->name('home');
            Route::post('/{user}/role-change', 'UsersController@changeRole')->name('change.role');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('delete');

        });
    });

});
