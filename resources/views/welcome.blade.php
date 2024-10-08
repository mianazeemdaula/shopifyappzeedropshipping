@extends('shopify-app::layouts.default')

@section('content')
    @livewire('dashboard')
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
            title: 'Settings',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection