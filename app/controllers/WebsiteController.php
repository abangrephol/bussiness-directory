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
        $this->theme = \Theme::uses(\CustomTheme::find($website->template_id)->theme_name)->layout('default');


        $this->theme->asset()->serve('website');

        $data = array(
            'id' => $id
        );

        if(isset($id) && $id!=''){
            $home =$website->page()->where('isHome',1)->first() ;
            if(isset($home->custom_data)){
                $custom_data = json_decode($home->custom_data);

                if(isset($custom_data->body_font)){
                    $this->theme->asset()->add('custom-font','//fonts.googleapis.com/css?family='.urlencode($custom_data->body_font));
                    $this->theme->asset()->writeStyle('inline-style', 'body,p { font-family: "'.$custom_data->body_font.'" !important; }', array());
                }
                if(isset($custom_data->banners)){
                    $data['banners'] = $custom_data->banners;
                }
            }


            if(isset($home)){
                $data['data'] = $home;
                $content = json_decode($home->content);

                foreach($content as $contentData => $oldData){
                    $content->$contentData = \Shortcode::compile($oldData);

                }
                $data['content'] = $content;

            }

        }

        return $this->theme->scope('template.index',$data)->render();
    }
    public function websitePage($id,$slug)
    {
        $website = CustomWebsite::find($id);
        $this->theme = \Theme::uses(\CustomTheme::find($website->template_id)->theme_name)->layout('default');

        $this->theme->asset()->serve('website');
        $data = array(
            'id' => $id
        );
        if(isset($slug) && $slug!=''){
            $page = \CustomWebsitePage::where('slug',$slug)->where('custom_website_id',$id)->first();
            if(isset($page->custom_data)){
                $custom_data = json_decode($page->custom_data);
                if(isset($custom_data->body_font)){
                    $this->theme->asset()->add('custom-font','//fonts.googleapis.com/css?family='.urlencode($custom_data->body_font));
                    $this->theme->asset()->writeStyle('inline-style', 'body,p { font-family: "'.$custom_data->body_font.'" !important; }', array());
                }
                if(isset($custom_data->banners)){
                    $data['banners'] = $custom_data->banners;
                }
            }
            if(isset($page)){
                $data['data'] = $page;
                $content = json_decode($page->content);

                foreach($content as $contentData => $oldData){
                    $content->$contentData = \Shortcode::compile($oldData);

                }
                $data['content'] = $content;
            }
            else{
                return Redirect::to('404');
            }

        }else{
            return Redirect::to('404');
        }
        return $this->theme->scope('template.index',$data)->render();
    }


}
