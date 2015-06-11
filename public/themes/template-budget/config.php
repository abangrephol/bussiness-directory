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
                //$asset->cook('bootstrap',function($asset){

                    $asset->cook('editor',function($asset){
                        $asset->usePath()->add('default-css','css/style.css');
                        $asset->container('footer')->add('editor','3rdparty/ckeditor/ckeditor.js');
                        $asset->container('footer')->add('editor-filemanager','3rdparty/filemanager/js/plugins.js');

                    });
                    $asset->cook('website',function($asset){
                        //$asset->container('footer')->add('jquery-ui','//code.jquery.com/jquery-1.11.0.min.js');
                        $asset->usePath()->add('default-css','css/style.css');
                        //$asset->container('editor')->add('bs-css','3rdparty/gridmanager/css/bootstrap.css');
                    });
                    $asset->cook('bootstrap',function($asset){


                        $asset->container('footer')->add('jquery-ui','//code.jquery.com/jquery-1.11.0.min.js');
                        $asset->container('footer')->add('jquery-migrate','//code.jquery.com/jquery-migrate-1.2.1.min.js');
                        $asset->container('footer')->usePath()->add('jpanelmenu','scripts/jquery.jpanelmenu.js');
                        $asset->container('footer')->usePath()->add('themepunch.plugins','scripts/jquery.themepunch.plugins.min.js');
                        $asset->container('footer')->usePath()->add('themepunch.revolution','scripts/jquery.themepunch.revolution.min.js');
                        $asset->container('footer')->usePath()->add('themepunch.showbizpro','scripts/jquery.themepunch.showbizpro.min.js');
                        $asset->container('footer')->usePath()->add('magnific-popup','scripts/jquery.magnific-popup.min.js');
                        $asset->container('footer')->usePath()->add('hoverIntent','scripts/hoverIntent.js');
                        $asset->container('footer')->usePath()->add('superfish','scripts/superfish.js');
                        $asset->container('footer')->usePath()->add('pureparallax','scripts/jquery.pureparallax.js');
                        $asset->container('footer')->usePath()->add('pricefilter','scripts/jquery.pricefilter.js');
                        $asset->container('footer')->usePath()->add('selectric','scripts/jquery.selectric.min.js');
                        $asset->container('footer')->usePath()->add('royalslider','scripts/jquery.royalslider.min.js');
                        $asset->container('footer')->usePath()->add('SelectBox','scripts/SelectBox.js');
                        $asset->container('footer')->usePath()->add('modernizr','scripts/modernizr.custom.js');
                        $asset->container('footer')->usePath()->add('waypoints','scripts/waypoints.min.js');
                        $asset->container('footer')->usePath()->add('flexslider','scripts/jquery.flexslider-min.js');
                        $asset->container('footer')->usePath()->add('counterup','scripts/jquery.counterup.min.js');
                        $asset->container('footer')->usePath()->add('tooltips','scripts/jquery.tooltips.min.js');
                        $asset->container('footer')->usePath()->add('isotope','scripts/jquery.isotope.min.js');
                        $asset->container('footer')->usePath()->add('puregrid','scripts/puregrid.js');
                        $asset->container('footer')->usePath()->add('stacktable','scripts/stacktable.js');
                        $asset->container('footer')->usePath()->add('custom','scripts/custom.js');

                        $asset->container('footer')->usePath()->add('iframe','scripts/iframeResizer.contentWindow.min.js');
                    });
                    /*
                    $asset->container('editor')->add('builder-config','3rdparty/alohaeditor/aloha-config.js');
                    $asset->container('editor')->add('aloha-css','3rdparty/alohaeditor/css/aloha.css');
                    $asset->container('editor')->add('require','3rdparty/alohaeditor/lib/require.js');
                    $asset->container('editor')->add('aloha','3rdparty/alohaeditor/lib/aloha.js',null,
                        array('data-aloha-plugins'=>"
                            common/ui,
                            common/format,
                            common/table,
                            common/list,
                            common/link,
                            common/image,
                            common/highlighteditables,
                            common/block,
                            common/undo,
                            common/paste,
                            common/commands,
                            common/abbr"
                        ));*/





                //});
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