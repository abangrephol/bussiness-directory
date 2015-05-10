<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Wirednest</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->container('editor')->styles() }}
    {{ Theme::asset()->scripts() }}

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body class="boxed">

    <div id="wrapper">
        {{ Theme::partial('header') }}
        {{ Theme::content() }}
        {{ Theme::partial('footer') }}
    </div>

    {{ Theme::asset()->container('editor')->scripts() }}
    {{ Theme::asset()->container('footer')->scripts() }}
</body>