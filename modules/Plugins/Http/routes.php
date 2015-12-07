<?php

Route::group(['prefix' => 'admin/plugins', 'namespace' => 'Modules\Plugins\Http\Controllers'], function()
{
	Route::get('/', 'PluginsController@index');
});