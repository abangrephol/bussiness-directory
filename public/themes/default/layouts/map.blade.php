<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::get('title') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="{{ Theme::get('keywords') }}">
    <meta name="description" content="{{ Theme::get('description') }}">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,600,800%7COpen+Sans:400italic,400,600,700' rel='stylesheet' type='text/css'>
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}
</head>
<body>
<div id="main-wrapper">
    {{ Theme::partial('headerMap') }}
    {{ Theme::content() }}
    {{ Theme::partial('footer') }}
</div>
{{ Theme::asset()->container('footer')->scripts() }}
</body>
</html>