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
    public function index()
    {



        $data = array('slug'=>'');
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
