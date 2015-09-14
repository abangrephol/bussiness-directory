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
                $asset->cook('editor',function($asset){
                    $asset->container('footer')->add('editor','3rdparty/ckeditor/ckeditor.js');
                    $asset->container('footer')->add('editor-js','3rdparty/ckeditor/builder.js');
                    $asset->container('footer')->add('editor-filemanager','3rdparty/filemanager/js/plugins.js');
                });
                $asset->cook('website',function($asset){
                    //$asset->container('footer')->add('jquery-ui','//code.jquery.com/jquery-1.11.0.min.js');

                });
                $asset->cook('bootstrap',function($asset){
                    $asset->usePath()->add('bootstrap-css','css/bootstrap.css');
                    $asset->usePath()->add('tinycolor-css','css/tinycolor.css');
                    $asset->usePath()->add('ani-css','css/ani.css');
                    $asset->usePath()->add('font-css','css/font.css');
                    $asset->usePath()->add('font-awesome-css','css/font-awesome.min.css');
                    $asset->usePath()->add('imagehover-css','css/imagehover.css');
                    $asset->usePath()->add('slick-css','css/slick.css');
                    $asset->usePath()->add('slick-theme-css','css/slick-theme.css');
                    $asset->usePath()->add('component-css','css/component.css');
                    $asset->container('footer')->usePath()->add('jquery','js/jquery.min.js');
                    $asset->container('footer')->usePath()->add('modernizr','js/modernizr.custom.js');
                });
//                <link href="aset/css/bootstrap.css" type="text/css" media="screen"  rel="stylesheet">
//                <link href="aset/css/tinycolor.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/ani.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/font.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/font-awesome.min.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/imagehover.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/slick.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/slick-theme.css" type="text/css" media="screen" rel="stylesheet">
//                <link href="aset/css/component.css" type="text/css" media="screen" rel="stylesheet">
//                <script src="aset/js/jquery.min.js"></script>
//                <script src="aset/js/modernizr.custom.js"></script>
            },
        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme)
        {
            // You can remove this line anytime.
            //$theme->setTitle('Copyright ©  2013 - Laravel.in.th');

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