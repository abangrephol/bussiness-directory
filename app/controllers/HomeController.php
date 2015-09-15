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
        $slug = '';
        $companies = Company::all();
        $mapMarker = array();
        foreach($companies as $company){
            $mapMarker [] = '{ address : "'.$company->address_1.' , '.$company->city.'",'
                            .'icon: "'.URL::to("/themes/default/assets").'/img/content/map-marker-company.png",'
                            .'html: "'.$company->name.'",'
                            .'title: "'.$company->name .'",'
                            .'id : "company-'.$company->id .'" }';
        }
        $mapMarker = join(',',$mapMarker);
        return $this->theme->scope('home.index',array(
            'marker'=>$mapMarker,
            'slug' => $slug
        ))->render();
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
