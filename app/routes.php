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
$appRoute = function()
{
    // Routes within each website
    Route::get('/', function($projectSlug) {
        $app = app();
        if(gettype($projectSlug)=='object'){
            $controller = $app->make('WebsiteController');
            return $controller->callAction('website', $parameters = array('id'=>$projectSlug->id));
        }else{
            $controller = $app->make('HomeController');
            return $controller->callAction('index', $parameters = array());
        }
    });

    Route::get('/{slug}', function($projectSlug,$slug) {
        $app = app();
        if(gettype($projectSlug)=='object'){

            $controller = $app->make('WebsiteController');
            return $controller->callAction('websitePage', $parameters = array('id'=>$projectSlug->id,'slug'=>$slug));
        }else{
            $controller = $app->make('HomeController');
            return $controller->callAction('index', $parameters = array('id'=>$projectSlug->id,'slug'=>$slug));
        }
    });

};
Route::group(['domain' => 'www.{projectSlug}.{tld}'], $appRoute);
Route::group(['domain' => '{projectSlug}.{tld}'], $appRoute);

Route::group(array('namespace'=>'Admin', 'prefix'=>'admin'),function(){
    Route::get('/login',array('as'=>'admin/login','uses'=>'SiteController@login'));
    Route::get('/logout',array('as'=>'admin/logout','uses'=>'SiteController@logout'));
    Route::post('/login','SiteController@login');
    Route::group(array('before'=>'admin_auth'),function(){
        Route::get('/',function(){
            return Redirect::to('admin/dashboard');
        });
        Route::get('dashboard',array('as'=>'admin/dashboard','uses'=>'SiteController@index'));
        Route::resource('companies','CompaniesController',array('names' => array('index'=>'admin/companies')));
        Route::resource('categories','CategoriesController',array('names' => array('index'=>'admin/categories')));
        Route::resource('users','UsersController',array('names' => array('index'=>'admin/users')));

        Route::resource('custom-website','CustomWebsitesController',array('names' => array('index'=>'admin/custom-website')));
        Route::get('custom-website/{id}/choose-templates',array('as'=>'custom-website.chooseTemplate','uses'=>'CustomWebsitesController@chooseTemplates'));
        Route::get('custom-website/{id}/builder/{templateId}/{pageId?}',array('as'=>'custom-website.builder','uses'=>'CustomWebsitesController@builder'));
        Route::get('custom-website/{id}/builder-editor/{templateId}/{pageId?}',array('as'=>'custom-website.builderEditor','uses'=>'CustomWebsitesController@builderEditor'));
        Route::post('custom-website/{id}/builder-save/{pageId?}',array('as'=>'custom-website.builderSave','uses'=>'CustomWebsitesController@builderSave'));
        Route::get('custom-website/{id}/pages',array('as'=>'custom-website.pages','uses'=>'CustomWebsitesController@pages'));
        Route::get('custom-website/{id}/pages-delete/{pageId}',array('as'=>'custom-website.pages.delete','uses'=>'CustomWebsitesController@pagesDelete'));
        Route::resource('custom-theme','CustomThemesController',array('names' => array('index'=>'admin/custom-theme')));
        Route::resource('custom-template','CustomTemplatesController',array('names' => array('index'=>'admin/custom-template')));
        Route::get('template-list',array('as'=>'template-list','uses'=>'CustomTemplatesController@templateList'));
        Route::get('custom-widget/{themeId}',array('as'=>'admin/custom-widget','uses'=>'CustomWidgetsController@index'));
        Route::get('custom-widget/{themeId}/create',array('as'=>'custom-widget.create','uses'=>'CustomWidgetsController@create'));
        Route::post('custom-widget/{themeId}/store',array('as'=>'custom-widget.store','uses'=>'CustomWidgetsController@store'));
        Route::get('custom-widget/{themeId}/{id}/edit',array('as'=>'custom-widget.edit','uses'=>'CustomWidgetsController@edit'));
        Route::put('custom-widget/{themeId}/{id}/update',array('as'=>'custom-widget.update','uses'=>'CustomWidgetsController@update'));
        Route::get('custom-widget/{themeId}/{id}/destroy',array('as'=>'custom-widget.destroy','uses'=>'CustomWidgetsController@destroy'));
        //Route::resource('custom-widget','CustomWidgetsController',array('names' => array('index'=>'admin/custom-widget')));
        Route::get('widget-list/{editor}',array('as'=>'widget-list','uses'=>'CustomWidgetsController@widgetList'));
        Route::get('widget-data',array('as'=>'widget-data','uses'=>'CustomWidgetsController@widgetData'));
        Route::get('widget-form/{id}/{widgetId?}',array('as'=>'widget-form','uses'=>'CustomWidgetsController@widgetForm'));
        Route::post('widget-save/{widgetId?}',array('as'=>'widget-save','uses'=>'CustomWidgetsController@widgetDataSave'));
        Route::get('widget-form-data/{widgetId}',array('as'=>'widget-form-data','uses'=>'CustomWidgetsController@widgetDataGet'));

        Route::group(array('prefix'=>'dt'),function(){
            Route::get('company',array('as'=>'dt.company','uses'=>'CompaniesController@getDatatableAll'));
            Route::get('user',array('as'=>'dt.user','uses'=>'UsersController@getDatatableAll'));
            Route::get('category',array('as'=>'dt.category','uses'=>'CategoriesController@getDatatableAll'));
            Route::get('custom-website',array('as'=>'dt.custom-website','uses'=>'CustomWebsitesController@getDatatableAll'));
            Route::get('custom-theme',array('as'=>'dt.custom-theme','uses'=>'CustomThemesController@getDatatableAll'));
            Route::get('custom-template',array('as'=>'dt.custom-template','uses'=>'CustomTemplatesController@getDatatableAll'));
            Route::get('custom-widget',array('as'=>'dt.custom-widget','uses'=>'CustomWidgetsController@getDatatableAll'));
            Route::get('custom-website-pages/{id}',array('as'=>'dt.custom-website-pages','uses'=>'CustomWebsitesController@getWebsitePages'));
        });


    });

});


//Route::get('/website/{id}','WebsiteController@website');

//Route::get('/','HomeController@index');
Route::get('/contact-us','HomeController@contact');
Route::get('/about-us','HomeController@about');
Route::get('/price-listing','HomeController@pricelisting');
Route::group(array('prefix'=>'companies'),function(){
    //Route::get('/','CategoriesController@index');
    Route::get('/','CategoriesController@index');
    Route::get('{categorySlug}','CategoriesController@slug');
    Route::get('detail/{id}','CompaniesController@index');
});


