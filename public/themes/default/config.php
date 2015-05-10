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
        'asset' => function($asset){
                $asset->cook('bootstrap',function($asset){
                    $asset->usePath()->add('default-css','css/style.css');

                    $asset->add('jquery','//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
                    $asset->container('footer')->add('jquery-ui','//code.jquery.com/ui/1.11.1/jquery-ui.js');
                    $asset->container('footer')->usePath()->add('jquery-ba','js/jquery.ba-outside-events.min.js');
                    $asset->container('footer')->usePath()->add('bootstrap','js/bootstrap.min.js');
                    $asset->container('footer')->add('gmap-api','//maps.google.com/maps/api/js?sensor=true');
                    $asset->container('footer')->usePath()->add('gomap','js/jquery.gomap-1.3.3.js');
                    $asset->container('footer')->usePath()->add('gmaps','js/gmaps.js');
                    $asset->container('footer')->usePath()->add('gmaps-cluster','js/markerclusterer.js');
                    $asset->container('footer')->usePath()->add('toggles','js/owl.carousel.js');
                    $asset->container('footer')->usePath()->add('custom','js/scripts.js');


                });
        },
        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme)
        {
            // You can remove this line anytime.
            $theme->setTitle('Wirednest Business Directory');

            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{{ $crumb["label"] }}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
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