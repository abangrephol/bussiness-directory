<?php namespace Modules\Plugins\Http\Controllers;

use Admin\BaseController;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Pingpong\Modules\Module;

class PluginsController extends BaseController {
    public function menu(){
        $menuAdd = array(
            'plugins' => array(
                'link' => 'plugins',
                'icon' => 'fa-home',
                'title' => 'Plugin & Apps',
            )
        );
        //dd(array_merge($params,$menuAdd));

        return $menuAdd;
    }

    public function subscribe($events)
    {
        $events->listen('admin.menus', 'Modules\Plugins\Http\Controllers\PluginsController@menu');
    }
	public function index()
	{
        $modules = \Module::all();
        foreach($modules as $module){
            if($module->name!="plugins"){
                //echo $module->name;
            }

        }
        return $this->theme->scope('site.index')->render();
	}
	
}