<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="favicon.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{request()->path()}}</title>
</head>
<body>
    
<div>
    @yield('container')
</div>
</body>
</html>