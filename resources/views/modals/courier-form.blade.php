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
      <label for="account" class="col-sm-2 control-label">Account</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="account" placeholder="Account Number" ng-model="vm.inputs.account_number">
      </div>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button class="btn btn-primary" type="button" ng-click="vm.ok()">Save</button>
  <button class="btn btn-warning" type="button" ng-click="vm.cancel()">Cancel</button>
</div>
