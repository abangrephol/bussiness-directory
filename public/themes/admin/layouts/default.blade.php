<!DOCTYPE html>
<html>
    <head>
        <title>{{ Theme::get('title') }}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{{ Theme::get('keywords') }}">
        <meta name="description" content="{{ Theme::get('description') }}">
        {{ Theme::asset()->styles() }}
        {{ Theme::asset()->scripts() }}
    </head>
    <body>
        <div id="preloader" >
            <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>
        <section>
            <div class="leftpanel">
                <div class="logopanel">
                    <h1><span>[</span> Business App <span>]</span></h1>
                </div>
                <div class="leftpanelinner">
                    {{ Theme::partial('menu') }}
                </div>

            </div>
            <div class="mainpanel">
                {{ Theme::partial('header') }}
                <div class="contentpanel">
                    {{ Theme::content() }}
                </div>

            </div>
        </section>

        {{ Theme::asset()->container('footer')->scripts() }}
    </body>
</html>