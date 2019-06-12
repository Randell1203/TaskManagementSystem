@extends('layouts.app')
{{-- Title --}}
@section('title','Users')

{{-- CSS --}}
@section('css-styles')

@endsection

{{-- Javascripts --}}
@section('js-scripts')
    <script src="{{ asset('js/vueJs/users.js') }}" defer></script>
@endsection

{{-- Main Content --}}
@section('content')
    
    <div id="usersVue">    
        <users-component></users-component>
    </div>
@endsection


