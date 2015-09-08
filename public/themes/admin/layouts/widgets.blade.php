<!DOCTYPE html>
<html>
<head>
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->container('style-after')->styles() }}
    {{ Theme::asset()->scripts() }}
</head>
<body class="">
<section>
    {{ Theme::content() }}
</section>

{{ Theme::asset()->container('footer')->scripts() }}
{{ Theme::asset()->container('footer-after')->scripts() }}
</body>
</html>