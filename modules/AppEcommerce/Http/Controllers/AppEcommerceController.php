<?php namespace Modules\AppEcommerce\Http\Controllers;

use Admin\BaseController;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class AppEcommerceController extends BaseController{

    public function index($prefix=null)
    {

        return $this->theme->scope('site.index')->render();
    }
    public function menu(){
        $menuAdd = array(
            'ecommerce' => array(
                'link' => 'shop',
                'icon' => 'fa-home',
                'title' => 'Ecommerce',
            )
        );
        //dd(array_merge($params,$menuAdd));

        return $menuAdd;
    }

    public function subscribe($events)
    {
        $events->listen('admin.menus', 'Modules\Appecommerce\Http\Controllers\AppEcommerceController@menu');
    }


	
}