<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(
        'asset' => function($asset)
        {
            $asset->cook('editor',function($asset){
                $asset->container('editor')->add('bs-css','3rdparty/gridmanager/css/bootstrap.css');
                //$asset->usePath()->add('default-css','css/style.css');
                //$asset->usePath()->add('green-css','css/colors/green.css');

                //$asset->container('footer')->add('jquery-ui','//code.jquery.com/jquery-1.11.0.min.js');

                $asset->container('editor')->add('grid-css','3rdparty/gridmanager/css/jquery.gridmanager.css');
                //$asset->container('editor')->add('jq','3rdparty/gridmanager/js/jquery.js');
                //$asset->container('editor')->add('bs','3rdparty/gridmanager/js/bootstrap.js');
                $asset->container('editor')->add('jui','3rdparty/gridmanager/js/jquery-ui.js');
                $asset->container('editor')->add('grid','3rdparty/gridmanager/js/jquery.gridmanager.js');

                $asset->container('editor')->usePath()->add('builder','js/builder.js');
                $asset->container('editor')->add('tinymce','//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.2/tinymce.min.js');
                $asset->container('editor')->add('jquery-tinymce','//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.2/jquery.tinymce.min.js');
            });
            $asset->cook('website',function($asset){
                $asset->container('footer')->add('jquery-ui','//code.jquery.com/jquery-1.11.0.min.js');

            });
            $asset->cook('bootstrap',function($asset){
                $asset->usePath()->add('bootstrap-css','css/bootstrap.css');
                $asset->usePath()->add('default-css','css/style.css');
                $asset->usePath()->add('animate-css','css/animate.css');
                $asset->container('footer')->usePath()->add('jquery','js/jquery.min.js');
                $asset->container('footer')->usePath()->add('bootstrap','js/bootstrap.min.js');
                $asset->container('footer')->usePath()->add('j-easing','js/jquery.easing.js');
                $asset->container('footer')->usePath()->add('j-waypoint','js/jquery-waypoints.js');
                $asset->container('footer')->usePath()->add('jquery.bxslider','js/jquery.bxslider.js');
                $asset->container('footer')->usePath()->add('jquery.flexslider-min.js','js/jquery.flexslider-min.js');
                $asset->container('footer')->usePath()->add('owl.carousel.min.js','js/owl.carousel.min.js');
                $asset->container('footer')->usePath()->add('imagesloaded.min.js','js/imagesloaded.min.js');
                $asset->container('footer')->usePath()->add('jquery.isotope.min.js','js/jquery.isotope.min.js');
                $asset->container('footer')->usePath()->add('jquery.sticky.js','js/jquery.sticky.js');
                $asset->container('footer')->usePath()->add('jflickrfeed.js','js/jflickrfeed.js');
                $asset->container('footer')->usePath()->add('jquery.transit.js','js/jquery.transit.js');
                $asset->container('footer')->usePath()->add('parallax.js','js/parallax.js');
                $asset->container('footer')->usePath()->add('jquery.appear.js','js/jquery.appear.js');
                $asset->container('footer')->usePath()->add('jquery.tweet.min.js','js/jquery.tweet.min.js');
                $asset->container('footer')->usePath()->add('jquery.animateNumber.js','js/jquery.animateNumber.js');
                $asset->container('footer')->usePath()->add('smoothscroll.js','js/smoothscroll.js');
                $asset->container('footer')->usePath()->add('main.js','js/main.js');
                $asset->container('footer')->usePath()->add('iframe','js/iframeResizer.contentWindow.min.js');
            });
        },
        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($asset)
        {

        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme)
        {
            $theme->asset()->serve('bootstrap');
            // You may use this event to set up your assets.
            // $theme->asset()->usePath()->add('core', 'core.js');
            // $theme->asset()->add('jquery', 'vendor/jquery/jquery.min.js');
            // $theme->asset()->add('jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', array('jquery'));

            // Partial composer.
            // $theme->partialComposer('header', function($view)
            // {
            //     $view->with('auth', Auth::user());
            // });
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(

            'default' => function($theme)
            {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }

        )

    )

);