@extends('layouts.main')

@section('title')
Login
@endsection

@section('contents')
<div class="container" ng-controller="LoginController as lc">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-inline" ng-submit="lc.login(lc.credentials)">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Username" ng-model="lc.credentials.username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" ng-model="lc.credentials.password">
        </div>
        <button type="submit" class="btn btn-default">Login</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/login/login.controller.js') }}"></script>
<script src="{{ asset('js/login/login.factory.js') }}"></script>
@endsection
