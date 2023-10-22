<!DOCTYPE html>
<html>
<head>
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    @routes
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
