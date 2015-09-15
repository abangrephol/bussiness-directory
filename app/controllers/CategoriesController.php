<?php

class CategoriesController extends BaseController {

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

    public function index($slug='')
    {
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
        $data = array(
            'marker'=>$mapMarker,
            'slug'=>$slug
        );
        return $this->theme->layout('map')->scope('categories.index',$data)->render();
    }
    public function slug($slug)
    {
        $category = Category::getBySlug($slug)->first();

        $companies = Category::find($category->id)->companies;
        $data = array('companies'=>$companies,'slug'=>$slug);
        return $this->theme->layout('map')->scope('categories.index',$data)->render();
    }

}
