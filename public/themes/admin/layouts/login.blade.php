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
<body class="signin">
<div id="preloader" >
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>
    {{ Theme::content() }}
</section>

{{ Theme::asset()->container('footer')->scripts() }}
</body>
</html>