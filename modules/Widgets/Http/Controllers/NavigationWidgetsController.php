<?php namespace Modules\Widgets\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Admin\BaseController;

class NavigationWidgetsController extends BaseController{

    public function navigation($menuId=""){
        $this->theme->setPageTitle('Create New Company');
        $this->theme->asset()->serve('jquery.serialize');
        $this->theme->asset()->serve('chosen');
        //return $this->theme->scope('companies.create')->render();
        $data = array(
            "menuId"=>$menuId,
            "navigations" => \CustomWidget::where('type',"menu")
                            ->where('theme_id',\Session::get('thid-editor'))->lists('name','id'),
            "pages" =>  \CustomWebsitePage::where("custom_website_id",\Session::get('webid-editor'))->get()
        );
        if($menuId!=""){
            $menuData = json_decode(\CustomWebsiteData::get_key(\Session::get('webid-editor'),$menuId));

            $data['menus'] = $menuData->menus ;

        }
        return $this->theme->layout('widgets')->load("modules.Widgets.Resources.Views.index",$data)->render();
    }

    public function navigationSave($menuId=0){
        $menus = \Input::get('menus');
        $navigationId = \Input::get('navigationId');
        if($menuId!=false){
            $data = [
                'navigationId' => $navigationId,
                'menus' => json_decode($menus)
            ];
            \CustomWebsiteData::set_key(\Session::get('webid-editor'),$menuId,json_encode($data));
        }else{
            $menuId = 'menu-'.\Session::get('webid-editor').'-'.time();
            $data = [
                'navigationId' => $navigationId,
                'menus' => json_decode($menus)
            ];
            \CustomWebsiteData::set_key(\Session::get('webid-editor'),$menuId,json_encode($data));
        }
        return $menuId;
    }
}
