@extends('shopify-app::layouts.default')

@section('content')
    @livewire('dashboard', ['data' => $data], key($data->orders ?? '1'))
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
            title: 'Dashboard',
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
