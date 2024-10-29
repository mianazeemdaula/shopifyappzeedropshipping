@extends('shopify-app::layouts.default')

@section('content')
    <div class="p-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-gray-800">Unsupported</h1>
            <p class="text-gray-600">This app is not supported in your country.</p>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script>
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Unsupported',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('refreshpage', (event) => {
                location.reload();
            });
        });
    </script>
@endsection
