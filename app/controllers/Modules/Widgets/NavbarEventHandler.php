<?php
namespace Modules\Widgets;
class NavbarEventHandler {

    public function __construct(){
        \Event::subscribe($this);
    }

    public function navbar($params=[]){
        echo "oke";
    }

    public function subscribe($events)
    {
        $events->listen('widget.navbar', 'Modules\Widgets\NavbarEventHandler@navbar');
    }
}