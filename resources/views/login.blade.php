@extends('layouts.main')

@section('title')
Login
@endsection

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}"/>
@endsection

@section('contents')
<div class="login" ng-controller="LoginController as lc">
    <form ng-submit="lc.login(lc.dredentials)">
        <img src="{{ asset('img/oppo_logo.png') }}">
        <input type="text" class="form-control" id="username" placeholder="Username" required ng-model="lc.dredentials.username">
        <input type="password" class="form-control" id="password" placeholder="Password" required ng-model="lc.dredentials.password">
        <button type="submit" class="btn btn-info btn-block btn-large">Login</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/login/login.controller.js') }}"></script>
<script src="{{ asset('js/login/login.factory.js') }}"></script>
@endsection
