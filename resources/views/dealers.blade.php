@extends('layouts.main')

@section('title')
Dealers
@endsection

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('contents')
<div class="container" ng-controller="DealersController as dc">
  <table class="table table-hover" datatable="" dt-options="dc.dtOptions" dt-columns="dc.dtColumns" dt-instance="dc.dtInstance">
  </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/dealers/dealers.controller.js') }}"></script>
<script src="{{ asset('js/dealers/dealer.factory.js') }}"></script>
<script src="{{ asset('js/couriers/courier.factory.js') }}"></script>
<script src="{{ asset('js/shared/modal-instance.controller.js') }}"></script>
<script src="{{ asset('js/shared/modal.factory.js') }}"></script>
@endsection
