{{-- @extends('shopify-app::layouts.default') --}}
@extends('layouts.web')

@section('content')
    <div class="p-4">
        @livewire('export-orders', ['orders' => $orders], key('export-orders'))
    </div>
    
@endsection
{{-- 
@section('scripts')
    @parent

    <script>
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Export Orders',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection --}}