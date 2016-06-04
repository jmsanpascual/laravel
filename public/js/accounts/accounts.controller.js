(function() {
    'use strict';

    angular
        .module('app')
        .controller('AccountsController', AccountsController);

    AccountsController.$inject = [
        '$scope',
        '$compile',
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
    function AccountsController($scope, $compile, DTOptionsBuilder,
        DTColumnBuilder, Role, Region, Permission, User, modal, toast) {

        var vm = this;
        var defaults = {};

        vm.users = {};
        vm.dtInstance = {};

        activate();

        function activate() {
            vm.dtOptions = DTOptionsBuilder
                .fromFnPromise(getUsers)
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

            // Fetch and cache all roles
            Role.query().$promise.then(function (roles) {
                defaults.roles = roles;
            });

            // Fetch and cache all regions
            Region.query().$promise.then(function (regions) {
                defaults.regions = regions;
            });

            // Fetch and cache all permissions
            Permission.query().$promise.then(function (permissions) {
                defaults.permissions = permissions;
            });

            function getUsers() {
                return User.query().$promise;
            }

            function addUser() {
                var params = {
                    templateUrl: 'js/shared/account-form-modal.html',
                    defaults: defaults,
                    inputs: {
                        role_id: defaults.roles[0].id
                    },
                    options: {
                        title: 'Create Account Information'
                    }
                };

                modal.form(params).then(function (result) {
                    // Instantiate a new user to be saved
                    var newUser = new User(result);

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
                templateUrl: 'js/shared/account-form-modal.html',
                defaults: defaults,
                inputs: angular.copy(user),
                options: {
                    title: 'Edit Account Information'
                }
            };

            // Edit some data and call server to make changes,
            // then reload the data so that DT is refreshed
            modal.form(params).then(function (result) {
                // Get the instance of the user to be updated
                user = result;

                user.$update().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };

        vm.delete = function (user) {
            modal.confirmation(user.name).then(function () {
                // Delete some data and call server to make changes,
                // then reload the data so that DT is refreshed
                user.$delete().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };
    }
})();
