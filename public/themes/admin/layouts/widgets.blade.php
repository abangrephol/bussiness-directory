<!DOCTYPE html>
<html>
<head>
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}
</head>
<body class="">
<section>
    {{ Theme::content() }}
</section>

{{ Theme::asset()->container('footer')->scripts() }}
</body>
</html>