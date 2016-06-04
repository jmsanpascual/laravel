<div class="modal-header">
  <h3 class="modal-title">@{{ vm.options.title }}</h3>
</div>
<div class="modal-body">
  <form class="form-horizontal">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Name" ng-model="vm.inputs.name">
      </div>
    </div>
    <div class="form-group">
      <label for="courier" class="col-sm-2 control-label">Courier</label>
      <div class="col-sm-10">
        <select class="form-control" id="courier" ng-options="courier.id as courier.name for courier in vm.defaults.couriers" ng-model="vm.inputs.courier_id"></select>
      </div>
    </div>
    <div class="form-group">
      <label for="region" class="col-sm-2 control-label">Region</label>
      <div class="col-sm-10">
        <select class="form-control" id="region" ng-model="vm.inputs.region_id">
          <option value="">-- Select a Region --</option>

          @foreach($user->regions as $region)
            @can('store', $region)
              <option value="{{ $region->id }}" ng-selected="{{ $region->id }} == vm.inputs.region_id">
                {{ $region->name }}
              </option>
            @elseif(isset($dealerId) && $dealerId == $region->id)
              <option value="" ng-selected="{{ $region->id }} == vm.inputs.region_id">
                {{ $region->name }}
              </option>
            @endcan
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="city" class="col-sm-2 control-label">City</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="city" placeholder="City" ng-model="vm.inputs.city">
      </div>
    </div>
    <div class="form-group">
      <label for="province" class="col-sm-2 control-label">Province</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="province" placeholder="Province" ng-model="vm.inputs.province">
      </div>
    </div>
    <div class="form-group">
      <label for="contact_person" class="col-sm-2 control-label">Contact Person</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="contact_person" placeholder="Contact Person" ng-model="vm.inputs.contact_person">
      </div>
    </div>
    <div class="form-group">
      <label for="contact_number" class="col-sm-2 control-label">Contact Number</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="contact_number" placeholder="Contact Number" ng-model="vm.inputs.contact_number">
      </div>
    </div>
    <div class="form-group">
      <label for="address1" class="col-sm-2 control-label">Address Line 1</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="address1" placeholder="Address Line 1" style="resize:none;" ng-model="vm.inputs.address_line_1"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="address2" class="col-sm-2 control-label">Address Line 2</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="address2" placeholder="Address Line 2" style="resize:none;" ng-model="vm.inputs.address_line_2"></textarea>
      </div>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button class="btn btn-primary" type="button" ng-click="vm.ok()">Save</button>
  <button class="btn btn-warning" type="button" ng-click="vm.cancel()">Cancel</button>
</div>
