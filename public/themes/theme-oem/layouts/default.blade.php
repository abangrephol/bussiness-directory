<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OEM</title>
    {{ Theme::asset()->container('editor')->styles() }}
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}
    <!--[if lt IE 9]>
    <script src="javascript/html5shiv.js"></script>
    <script src="javascript/respond.min.js"></script>
    <![endif]-->
</head>
<body>

{{ Theme::partial('header') }}
{{ Theme::content() }}
{{ Theme::partial('footer') }}
{{ Theme::asset()->container('editor')->scripts() }}
{{ Theme::asset()->container('footer')->scripts() }}

</body>