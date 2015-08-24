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
                $asset->usePath()->add('default-css','css/style.default.css');
                $asset->add('fa','//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

                $asset->usePath()->add('jquery','js/jquery-1.10.2.min.js');
                $asset->container('footer')->usePath()->add('jquery-migrate','js/jquery-migrate-1.2.1.min.js');
                $asset->container('footer')->usePath()->add('jquery-ui','js/jquery-ui-1.10.3.min.js');
                $asset->container('footer')->usePath()->add('jquery-cookie','js/jquery.cookies.js');
                $asset->container('footer')->usePath()->add('bootstrap','js/bootstrap.min.js');
                $asset->container('footer')->usePath()->add('modernizr','js/modernizr.min.js');
                $asset->container('footer')->usePath()->add('toggles','js/toggles.min.js');
                $asset->container('footer')->usePath()->add('validate','js/jquery.validate.min.js');

                $asset->container('footer')->usePath()->add('modernizr','js/custom.js');

            });
            $asset->cook('datatable',function($asset){
                $asset->container('style-after')->usePath()->add('datatable-css','css/jquery.datatables.css');
                $asset->container('footer-after')->usePath()->add('datatable','js/jquery.datatables.min.js');
            });
            $asset->cook('tags',function($asset){
                $asset->container('style-after')->usePath()->add('datatable-css','css/jquery.tagsinput.css');
                $asset->container('footer-after')->usePath()->add('datatable','js/jquery.tagsinput.min.js');
            });
            $asset->cook('ckeditor',function($asset){
                $asset->container('footer-after')->usePath()->add('ckeditor','js/ckeditor/ckeditor.js');
                $asset->container('footer-after')->usePath()->add('ckeditor-jquery','js/ckeditor/adapters/jquery.js');
            });
            $asset->cook('codemirror',function($asset){
                $asset->container('footer-after')->usePath()->add('codemirror','js/codemirror2/lib/codemirror.js');
                $asset->container('footer-after')->usePath()->add('codemirror-xml','js/codemirror2/mode/xml/xml.js');
                $asset->container('footer-after')->usePath()->add('codemirror-css','js/codemirror2/mode/css/css.js');
                $asset->container('footer-after')->usePath()->add('codemirror-javascript','js/codemirror2/mode/javascript/javascript.js');
                $asset->container('footer-after')->usePath()->add('codemirror-html','js/codemirror2/mode/htmlmixed/htmlmixed.js');
                $asset->container('style-after')->usePath()->add('codemirror-css','js/codemirror2/lib/codemirror.css');
            });
            $asset->cook('chosen',function($asset){
                $asset->container('footer-after')->usePath()->add('chosen','js/select2.min.js');
            });
            $asset->cook('gmap',function($asset){
                $asset->container('footer-after')->add('gmap-api','//maps.google.com/maps/api/js?sensor=true');
                $asset->container('footer-after')->usePath()->add('gmap','js/gmaps.js');
            });
            $asset->cook('color-picker',function($asset){
                $asset->container('style-after')->usePath()->add('cp-css','css/colorpicker.css');
                $asset->container('footer-after')->usePath()->add('cp','js/colorpicker.js');
            });
            $asset->cook('fileupload',function($asset){
                $asset->container('style-after')->usePath()->add('fileupload-css','css/bootstrap-fileupload.min.css');
                $asset->container('footer-after')->usePath()->add('fileupload-js','js/bootstrap-fileupload.min.js');
                $asset->container('style-after')->usePath()->add('fancy-css','css/jquery.fancybox-1.3.4.css');
                $asset->container('footer-after')->usePath()->add('fancy-js','js/jquery.fancybox-1.3.4.pack.js');
            });
            $asset->cook('builder',function($asset){
                //$asset->add('aloha-css','3rdparty/alohaeditor/css/aloha.css');
                //$asset->container('footer-after')->usePath()->add('require','js/aloha-config.js');
                //$asset->container('footer-after')->add('require','3rdparty/alohaeditor/lib/require.js');
                //$asset->container('footer-after')->add('aloha','3rdparty/alohaeditor/lib/aloha.js',null,array('data-aloha-plugins'=>"common/ui,common/format,common/list,common/link,common/highlighteditables"));
                $asset->container('style-after')->usePath()->add('gritter-css','css/jquery.gritter.css');
                $asset->container('footer-after')->usePath()->add('sticky','js/jquery.sticky.js');
                $asset->container('footer-after')->usePath()->add('gritter','js/jquery.gritter.min.js');
                $asset->container('footer-after')->usePath()->add('nestedSortable','js/jquery.mjs.nestedSortable.js');
                $asset->container('footer-after')->add('tinymce','3rdparty/ckeditor/ckeditor.js');

            });
            $asset->cook('iframe',function($asset){

                $asset->container('footer-after')->usePath()->add('iframe','js/iframeResizer.min.js');
            });

            $asset->cook('mustache',function($asset){

                $asset->container('footer')->add('mustache','3rdparty/mustache/mustache.min.js');
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

            $theme->breadcrumb()->setTemplate('
                <ol class="breadcrumb">
                @foreach ($crumbs as $i => $crumb)
                     @if ($i != (count($crumbs) - 1))
                     <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a></li>
                     @else
                     <li class="active">{{ $crumb["label"] }}</li>
                     @endif
                @endforeach
                </ol>
            ');
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme)
        {
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
                $theme->asset()->serve('bootstrap');
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            },
            'login' => function($theme)
            {
                $theme->asset()->serve('bootstrap');
            },
            'widgets' => function($theme)
            {
                $theme->asset()->serve('bootstrap');
                $theme->asset()->serve('mustache');
            },

        )

    )

);