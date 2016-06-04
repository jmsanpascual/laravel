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
      <label for="region_code" class="col-sm-2 control-label">Region Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="region_code" placeholder="Region Code" ng-model="vm.inputs.region_code">
      </div>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button class="btn btn-primary" type="button" ng-click="vm.ok()">Save</button>
  <button class="btn btn-warning" type="button" ng-click="vm.cancel()">Cancel</button>
</div>
