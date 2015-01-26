<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('namespace'=>'Admin', 'prefix'=>'admin'),function(){
    Route::get('/login','SiteController@login');
    Route::group(array(),function(){
        Route::get('/','SiteController@index');
    });
});