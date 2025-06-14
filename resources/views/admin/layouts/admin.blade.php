@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    @yield('content')
@endsection

@section('css')
    @vite(['resources/css/admin.custom.css'])
@endsection

@section('js')
    @vite(['resources/js/admin.custom.js'])
    @stack('scripts')
@endsection
