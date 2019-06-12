<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="user_id" content="{{ optional(Auth::user())->id }}">
    <meta name="user_type" content="{{ optional(Auth::user())->user_type }}">
    <meta name="base_url" content="{{ URL('/')}}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css-styles')

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- Addional scripts --}}
    @yield('js-scripts')

</head>
<body>
    <div class="app body-wrapper">
        {{-- HEADER --}}
        <header>
            <div id="navigationVue">
                @php
                    $auth_user= Auth::user();
                    if(Auth::check()){
                        $auth_user = $auth_user->toJson();
                    }
                @endphp
                <navigationcomponent :is_authenticated="'{{Auth::check()}}'" :auth_user="{{$auth_user }}"></navigationcomponent>
            </div>
        </header>
        {{-- MAIN CONTENT --}}
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        
        {{-- FOOTER --}}
        <footer>
            <div id="footerVue">
                <footercomponent></footercomponent>
            </div>
        </footer>
    </div>


</body>


</html>
