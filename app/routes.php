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
HTML::macro('clever_link', function($route, $text,$iconClass) {
    if(Request::is($route) || Request::is($route."/*")) { //
        $active = "class = 'active'";
    }
    else {
        $active = '';
    }
    /*<li class=""><a href=""><i class="fa fa-envelope-o"></i> <span>Email</span></a></li>*/
    return '<li ' . $active . '><a href="' . URL::route($route).'"><i class="'.$iconClass.'"></i><span>' . $text
        . '</span></a></li>';
});

//Route::group('/',function(){
    Route::get('/','HomeController@index');
//});
Route::group(array('namespace'=>'Admin', 'prefix'=>'admin'),function(){
    Route::get('/',function(){
        return Redirect::to('admin/dashboard');
    });
    Route::get('/login','SiteController@login');
    Route::group(array(),function(){
        Route::get('dashboard',array('as'=>'admin/dashboard','uses'=>'SiteController@index'));
        Route::resource('companies','CompaniesController',array('names' => array('index'=>'admin/companies')));
        Route::resource('categories','CategoriesController',array('names' => array('index'=>'admin/categories')));
        Route::group(array('prefix'=>'dt'),function(){
            Route::get('company',array('as'=>'dt.company','uses'=>'CompaniesController@getDatatableAll'));
            Route::get('category',array('as'=>'dt.category','uses'=>'CategoriesController@getDatatableAll'));
        });

    });

});