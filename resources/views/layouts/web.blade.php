<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zee DropShipping</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-gray-50">
    <main role="main">
        @yield('content')
    </main>
    @livewireScripts

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('refreshpage', (event) => {
                location.reload();
            });
        });
    </script>

    <script>
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Login',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
</body>

</html>
