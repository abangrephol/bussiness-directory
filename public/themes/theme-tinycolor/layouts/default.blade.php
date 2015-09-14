
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Tiny Color</title>
    <link rel="shortcut icon" type="image/png" href="aset/img/favicon.png"/>

    {{ Theme::asset()->container('editor')->styles() }}
    {{ Theme::asset()->styles() }}

    {{ Theme::asset()->scripts() }}

</head>
<body >

{{ Theme::partial('header') }}
{{ Theme::content() }}
{{ Theme::partial('footer') }}
{{ Theme::asset()->container('editor')->scripts() }}
{{ Theme::asset()->container('footer')->scripts() }}

</body>

</html>