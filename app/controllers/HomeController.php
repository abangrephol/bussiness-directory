<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{

        return $this->theme->scope('home.index')->render();
	}
    public function about()
    {
        Theme::setPageTitle('ABOUT US');
        return $this->theme->layout('page')->scope('home.about')->render();
    }
    public function contact()
    {
        Theme::setPageTitle('CONTACT US');
        return $this->theme->layout('page')->scope('home.contact')->render();
    }
    public function pricelisting()
    {
        Theme::setPageTitle('PRICE LISTING');
        return $this->theme->layout('page')->scope('home.pricelisting')->render();
    }


}
