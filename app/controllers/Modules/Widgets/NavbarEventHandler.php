<?php
namespace Modules\Widgets;
class NavbarEventHandler {

    public function __construct(){
        \Event::subscribe($this);
    }

    public function navbar($params=[]){
        $menuAdd = array(
            'aafa' => array(
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
        $events->listen('admin.menus', 'Modules\Widgets\NavbarEventHandler@navbar');
    }
}