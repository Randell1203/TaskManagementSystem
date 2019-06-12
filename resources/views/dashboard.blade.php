@extends('layouts.app')
{{-- Title --}}
@section('title','Dashboard')

{{-- CSS --}}
@section('css-styles')

@endsection

{{-- Javascripts --}}
@section('js-scripts')
    <script src="{{ asset('js/vueJs/dashboard.js') }}" defer></script>
@endsection

{{-- Main Content --}}
@section('content')
    <div id="dashboardVue">    
        <dashboard-component></dashboard-component>
    </div>
@endsection


