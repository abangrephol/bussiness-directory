<?php

Route::group(['prefix' => 'admin/widgets', 'namespace' => 'Modules\Widgets\Http\Controllers'], function()
{
	Route::get('/', 'WidgetsController@index');

    Route::group(['prefix' => 'navigation'], function(){
        Route::get('/{id?}', 'NavigationWidgetsController@navigation');
        Route::get('save/{id?}', 'NavigationWidgetsController@navigationSave');
    });
});