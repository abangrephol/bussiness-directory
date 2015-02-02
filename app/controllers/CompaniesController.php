<?php

class CompaniesController extends BaseController {

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

    public function index($id)
    {

        $companies = Company::find($id);
        //dd($companies->name);
        Theme::setCompanyName($companies->name);
        Theme::setCompany($companies);
        $data = array('company'=>$companies);
        return $this->theme->layout('company')->scope('companies.index',$data)->render();
    }

}
