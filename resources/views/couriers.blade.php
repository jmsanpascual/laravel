@extends('layouts.main')

@section('title')
Couriers
@endsection

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('contents')
<div class="container" ng-controller="CourierController as cc">
  <table class="table table-hover" datatable="" dt-options="cc.dtOptions" dt-columns="cc.dtColumns" dt-instance="cc.dtInstance">
  </table>
  <div class="row" ng-if="cc.upload.show" ng-cloak>
    <h3 ng-bind="cc.title"></h3>
    <hr>
    <form class="form-horizontal" ng-submit="cc.uploadTemplate(cc.template)">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="dealer_name" class="col-sm-3 control-label">Dealer Name</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="dealer_name" placeholder="Excel Column" ng-model="cc.template.name">
          </div>
        </div>
        <div class="form-group">
          <label for="city" class="col-sm-3 control-label">City</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="city" placeholder="Excel Column" ng-model="cc.template.city">
          </div>
        </div>
        <div class="form-group">
          <label for="province" class="col-sm-3 control-label">Province</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="province" placeholder="Excel Column" ng-model="cc.template.province">
          </div>
        </div>
        <div class="form-group">
          <label for="contact_person" class="col-sm-3 control-label">Contact Person</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="contact_person" placeholder="Excel Column" ng-model="cc.template.contact_person">
          </div>
        </div>
        <div class="form-group">
          <label for="contact_number" class="col-sm-3 control-label">Contact Number</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="contact_number" placeholder="Excel Column" ng-model="cc.template.contact_number">
          </div>
        </div>
        <div class="form-group">
          <label for="address1" class="col-sm-3 control-label">Address 1</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="address1" placeholder="Excel Column" ng-model="cc.template.address_line_1">
          </div>
        </div>
        <div class="form-group">
          <label for="address2" class="col-sm-3 control-label">Address 2</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="address2" placeholder="Excel Column" ng-model="cc.template.address_line_2">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-3 col-sm-offset-3">
            <button class="btn btn-success btn-sm" type="submit">
              Save
            </button>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="company_name" class="col-sm-3 control-label">Company Name</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="company_name" placeholder="Excel Column" ng-model="cc.template.company_name">
          </div>
        </div>
        <div class="form-group">
          <label for="sender_name" class="col-sm-3 control-label">Sender Name</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="sender_name" placeholder="Excel Column" ng-model="cc.template.sender_name">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-3 control-label">Phone</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="phone" placeholder="Excel Column" ng-model="cc.template.phone_number">
          </div>
        </div>
        <div class="form-group">
          <label for="telephone" class="col-sm-3 control-label">Telephone</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="telephone" placeholder="Excel Column" ng-model="cc.template.telephone_number">
          </div>
        </div>
        <div class="form-group">
          <label for="address" class="col-sm-3 control-label">Address</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="address" placeholder="Excel Column" ng-model="cc.template.address">
          </div>
        </div>
        <div class="form-group">
          <label for="template" class="col-sm-3 control-label">Excel Template</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="template" placeholder="Excel Template" readonly ng-model="cc.template.excel.name">
          </div>
          <label class="btn btn-default btn-file">
              Browse <input type="file" style="display: none;" file-model="cc.template.excel">
          </label>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/couriers/courier.controller.js') }}"></script>
<script src="{{ asset('js/couriers/courier.factory.js') }}"></script>
<script src="{{ asset('js/couriers/upload.directive.js') }}"></script>
<script src="{{ asset('js/shared/modal-instance.controller.js') }}"></script>
<script src="{{ asset('js/shared/modal.factory.js') }}"></script>
@endsection
