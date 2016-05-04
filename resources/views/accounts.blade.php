@extends('layouts.main')

@section('title')
Accounts
@endsection

@include('layouts.navbar')

@section('contents')
<div class="container" ng-controller="AccountsController as ac">
  <table class="table table-hover" datatable="" dt-options="ac.dtOptions" dt-columns="ac.dtColumns" dt-instance="ac.dtInstance">
  </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/accounts/accounts.controller.js') }}"></script>
<script src="{{ asset('js/accounts/role.factory.js') }}"></script>
<script src="{{ asset('js/accounts/permission.factory.js') }}"></script>
<script src="{{ asset('js/accounts/region.factory.js') }}"></script>
<script src="{{ asset('js/shared/modal-instance.controller.js') }}"></script>
<script src="{{ asset('js/shared/modal.factory.js') }}"></script>
<script src="{{ asset('js/shared/user.factory.js') }}"></script>
@endsection
