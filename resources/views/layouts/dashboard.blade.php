@extends('layouts.index')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
    <style type="text/css" media="screen">
        .container {
            margin-top: 25px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-3">
                <aside class="menu">
                    <p class="menu-label">
                        General
                    </p>
                    <ul class="menu-list">
                        <li><a href="{{ url('dashboard') }}" class="@yield('cl-dashboard')">Dashboard</a></li>
                        @if (Auth::user()->rol === 'admin')
                            <li><a href="{{ url('dashboard/customers') }}" class="@yield('cl-customers')">Customers</a></li>
                        @endif
                    </ul>
                    <p class="menu-label">
                        Security
                    </p>
                    <ul class="menu-list">
                        <li><a href="{{ url('dashboard/profile') }}" class="@yield('cl-profile')">My Profile</a></li>
                    </ul>
                </aside>
            </div>
            <div class="column is-9">
                @yield('main')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script async type="text/javascript" src="{{ asset('js/bulma.js') }}"></script>
@endsection