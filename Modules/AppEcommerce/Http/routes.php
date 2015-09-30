<?php

Route::group(['prefix' => 'admin/shop', 'namespace' => 'Modules\AppEcommerce\Http\Controllers','before'=>'admin_auth'], function()
{
	Route::get('/', 'AppEcommerceController@index');
});