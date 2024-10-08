<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zee Drop Shipping</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>
<body class="bg-gray-50">
    <main role="main">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>