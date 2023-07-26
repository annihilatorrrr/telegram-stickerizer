<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebApp</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    @vite([
        'resources/css/app.scss',
        'resources/css/webapp.scss'
    ])
    @stack('styles')
</head>
<body>
@yield('content')

@routes
@stack('scripts')
</body>
</html>
