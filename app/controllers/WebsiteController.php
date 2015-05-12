<?php

class WebsiteController extends BaseController {

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

    public function website($id)
    {
        $website = CustomWebsite::find($id);
        $this->theme = \Theme::uses(\CustomTemplate::find($website->template_id)->theme_name)->layout('default');
        $this->theme->asset()->serve('website');
        $pageId = \Input::get('pageId');
        $data = array(
            'id' => $id
        );
        if(isset($pageId) && $pageId!=0){
            $data['data'] = \CustomWebsitePage::find($pageId);
        }
        return $this->theme->scope('template.index',$data)->render();
    }


}
