@extends('layouts.app')
{{-- Title --}}
@section('title','Tasks')

{{-- CSS --}}
@section('css-styles')

@endsection

{{-- Javascripts --}}
@section('js-scripts')
    <script src="{{ asset('js/vueJs/tasks.js') }}" defer></script>
@endsection

{{-- Main Content --}}
@section('content')
    
    <div id="tasksVue">    
        <task-component :auth_user="{{json_encode(Auth::user()) }}"></task-component>
    </div>
@endsection


