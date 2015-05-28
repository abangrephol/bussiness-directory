<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Avent - Multipurpose Template</title>
    <meta name="description" content="business, eCommerce, clean, twitter, bootstrap 2, responsive">
    <meta name="keywords" content="Avent is a professional multipurpose template for any business, eCommerce, portfolio or blog website.">
    <meta name="author" content="Rollthemes.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Sanchez:400italic,400' rel='stylesheet' type='text/css'>
    {{ Theme::asset()->container('editor')->styles() }}
    {{ Theme::asset()->styles() }}

    {{ Theme::asset()->scripts() }}

    <!-- Favicon and touch icons  -->
    <!--link href="icon/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
    <link href="icon/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
    <link href="icon/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
    <link href="icon/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon-precomposed">
    <link href="icon/favicon.png" rel="shortcut icon"-->

    <!--[if lt IE 9]>
    <script src="javascript/html5shiv.js"></script>
    <script src="javascript/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    {{ Theme::partial('header') }}
    {{ Theme::content() }}
    {{ Theme::partial('footer') }}
    {{ Theme::asset()->container('footer')->scripts() }}
    {{ Theme::asset()->container('editor')->scripts() }}
</body>

</html>