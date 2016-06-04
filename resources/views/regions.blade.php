@extends('layouts.main')

@section('title')
Regions
@endsection

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('contents')
<div class="container" ng-controller="RegionController as rc">
  <table class="table table-hover" datatable="" dt-options="rc.dtOptions" dt-columns="rc.dtColumns" dt-instance="rc.dtInstance">
  </table>
@endsection

@section('scripts')
<script src="{{ asset('js/regions/regions.controller.js') }}"></script>
<script src="{{ asset('js/regions/regions.factory.js') }}"></script>
<script src="{{ asset('js/shared/modal-instance.controller.js') }}"></script>
<script src="{{ asset('js/shared/modal.factory.js') }}"></script>
@endsection
