<!DOCTYPE html>
<html>
    <head>
        <title>{{ Theme::get('title') }}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{{ Theme::get('keywords') }}">
        <meta name="description" content="{{ Theme::get('description') }}">
        {{ Theme::asset()->styles() }}
        {{ Theme::asset()->container('style-after')->styles() }}
        {{ Theme::asset()->scripts() }}
        <style>
            label.required:after {
                color: #D9534F;
                padding-left:4px;
                content: " *";
            }
        </style>
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
                <div class="pageheader">
                    <h2><i class="fa fa-table"></i> {{ Theme::get('pageTitle') }} <span> {{ Theme::get('pageSubTitle') }}</span></h2>
                    <div class="breadcrumb-wrapper">
                        <span class="label">You are here:</span>
                        {{ Theme::breadcrumb()->render() }}
                    </div>
                </div>
                <div class="contentpanel">
                    {{ Theme::content() }}
                </div>

            </div>
        </section>

        {{ Theme::asset()->container('footer')->scripts() }}
        {{ Theme::asset()->container('footer-after')->scripts() }}
    </body>
</html>