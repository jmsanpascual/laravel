(function() {
    'use strict';

    angular
        .module('app')
        .controller('AccountsController', AccountsController);

    AccountsController.$inject = [
        '$scope',
        '$compile',
        '$cookies',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        'Role',
        'Region',
        'Permission',
        'User',
        'modal',
        'toast'
    ];

    /* @ngInject */
    function AccountsController($scope, $compile, $cookies, DTOptionsBuilder,
        DTColumnBuilder, Role, Region, Permission, User, modal, toast) {

        var vm = this;
        var defaults = {};

        vm.users = {};
        vm.dtInstance = {};

        activate();

        function activate() {
            vm.dtOptions = DTOptionsBuilder
                .fromFnPromise(getUsers)
                // .newOptions()
                // .withOption('ajax', {
                //      dataSrc: 'data',
                //      url: 'user',
                //      type: 'POST',
                //      headers: {
                //         'X-XSRF-TOKEN': $cookies.get('XSRF-TOKEN')
                //      }
                //  })
                // .withOption('processing', true)
                // .withOption('serverSide', true)
                .withDOM('lfBrtip') // Position the buttons in the center
                .withPaginationType('full_numbers')
                .withOption('createdRow', createdRow)
                .withOption( 'lengthMenu', [8, 10, 20, 50, 100])
                .withFixedHeader() // Enable fixed header in datatables
                .withBootstrap()
                .withBootstrapOptions({
                    pagination: {
                        classes: {
                            ul: 'pagination pagination-sm'
                        }
                    }
                })
                .withButtons([
                    'colvis',
                    {
                        text: 'Add User',
                        key: '1',
                        action: addUser
                    }
                ]);

            vm.dtColumns = [
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('role.name').withTitle('Role'),
                DTColumnBuilder.newColumn('username').withTitle('Username'),
                DTColumnBuilder.newColumn(null).withTitle('Actions')
                    .notSortable().renderWith(actionsHtml)
            ];

            Role.query().$promise.then(function (roles) {
                defaults.roles = roles;
            });

            Region.query().$promise.then(function (regions) {
                defaults.regions = regions;
            });

            Permission.query().$promise.then(function (permissions) {
                defaults.permissions = permissions;
            });

            function getUsers() {
                return User.query().$promise;
            }

            function addUser() {
                var params = {
                    defaults: defaults,
                    inputs: {
                        role_id: defaults.roles[0].id
                    }
                };

                modal.form(params).then(function (result) {
                    // Instantiate a new user to be saved
                    var newUser = new User(result.inputs);

                    newUser.$save(function (response) {
                        vm.dtInstance.reloadData(angular.noop, false);
                        toast.success(response.message);
                    }, function (errorMsg) {
                        toast.error(errorMsg, true);
                    });
                });
            }

            function createdRow(row, data, dataIndex) {
                // Recompiling so we can bind Angular directive to the DT
                $compile(angular.element(row).contents())($scope);
            }

            function actionsHtml(data, type, full, meta) {
                vm.users[data.id] = data;
                return '<button class="btn btn-success" ng-click="ac.edit(ac.users[' + data.id + '])">' +
                    '   <i class="fa fa-edit"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-danger" ng-click="ac.delete(ac.users[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-trash-o"></i>' +
                    '</button>';
            }
        }

        vm.edit = function (user) {
            var regionsLen = user.regions.length;
            var permissionsLen = defaults.permissions.length;

            // Temporary solution for building the permissions array,
            // to be used on setting the values for ui-select permissions
            for (var x = 0; x < regionsLen; x++) {
                var region = user.regions[x];
                region.permissions = [];

                for (var i = 0; i < permissionsLen; i++) {
                    // Check if permission bit is available in region permission
                    var permissions = region.pivot.permission;
                    var bit = permissions & defaults.permissions[i].bit;
                    if (!bit) continue;

                    region.permissions.push({
                        'bit': defaults.permissions[i].bit,
                        'name': defaults.permissions[i].name
                    });
                }
            }

            var params = {
                defaults: defaults,
                inputs: angular.copy(user)
            };

            // Edit some data and call server to make changes,
            // then reload the data so that DT is refreshed
            modal.form(params).then(function (result) {
                // Get the instance of the user to be updated
                user = result.inputs;

                user.$update().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        }

        vm.delete = function (user) {
            modal.confirmation(user.name).then(function (result) {
                // Delete some data and call server to make changes,
                // then reload the data so that DT is refreshed
                user.$delete().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        }
    }
})();
