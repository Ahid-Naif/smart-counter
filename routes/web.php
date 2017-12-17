<?php

Route::get('/', ['uses' => 'PageController@home'])->name('home');
Route::get('/about', ['uses' => 'PageController@about'])->name('about.index');

Route::post('/login/validate/matric_uuid', ['uses' => 'Auth\LoginController@validateMatricUUID']);
Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => '/portal', 'middleware' => 'auth'], function(){
    Route::get('/', ['uses' => 'PortalController@index'])->name('portal.index');
    Route::post('/applications', ['uses' => 'PortalController@applications']);

    Route::group(['prefix' => '/application'], function(){
        Route::get('/create', ['uses' => 'ApplicationController@create'])->name('portal.application.create');
        Route::post('/store', ['uses' => 'ApplicationController@store']);
        Route::post('/types', ['uses' => 'ApplicationController@types']);
    });
    
    Route::group(['prefix' => '/college'], function(){
        Route::post('/courses', ['uses' => 'CollegeController@courses']);
    });
});

Route::get('/cards/{card}', function($card){
    event(new \App\Events\NewCard($card));
    echo "okay la";
});