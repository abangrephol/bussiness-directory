<?php namespace Modules\Widgets\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Admin\BaseController;

class WidgetsController extends Controller{

    public function index(){
        return \Shortcode::compile("[nav]{{#menus}} {{.}} {{/menus}}[/nav]");
    }

    public function register($attr, $content = null, $name = null)
    {
        $text = \Shortcode::compile($content);
        return '<div'.\HTML::attributes($attr).'>'. $text .'</div>';
    }
    public function nav($attr, $content = null, $name = null)
    {
        $text = \Shortcode::compile($content);

        $me = new \Mustache_Engine();


        $menus = \CustomWebsiteData::get_key1($attr['id']);


        $menusData =json_decode($menus);
        //dd(json_decode($menus)->menus);
        $menuTemplate = \CustomWidget::find($menusData->navigationId);
        $attr['menus'] = $menusData->menus;
        //dd($attr['menus']);
        $text = $me->render($menuTemplate->template,$attr);
        return '<div>'. $text .'</div>';
    }
}
