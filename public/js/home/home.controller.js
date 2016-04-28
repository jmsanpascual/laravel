(function() {
    'use strict';

    angular
        .module('app')
        .controller('HomeController', HomeController);

    HomeController.$inject = [
        '$scope',
        '$compile',
        '$cookies',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        'role',
        'country',
        'user',
        'modal',
        'toast'
    ];

    /* @ngInject */
    function HomeController($scope, $compile, $cookies, DTOptionsBuilder, DTColumnBuilder,
        role, country, user, modal, toast) {

        var vm = this;
        vm.users = {};
        vm.roles = [];
        vm.countries = [];
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

            role.query().$promise.then(function (roles) {
                vm.roles = roles;
            });

            country.query().$promise.then(function (countries) {
                vm.countries = countries;
            });

            function getUsers() {
                return user.query().$promise;
            }

            function addUser(e, dt, node, config) {
                var params = {
                    defaults: {
                        roles: vm.roles,
                        countries: vm.countries
                    },
                    inputs: {role_id: vm.roles[0].id}
                };

                modal.form(params).then(function (result) {
                    var newUser = new user(result.inputs);
                    console.log(newUser);
                });
            }

            function createdRow(row, data, dataIndex) {
                // Recompiling so we can bind Angular directive to the DT
                $compile(angular.element(row).contents())($scope);
            }

            function actionsHtml(data, type, full, meta) {
                vm.users[data.id] = data;
                return '<button class="btn btn-success" ng-click="hc.edit(hc.users[' + data.id + '])">' +
                    '   <i class="fa fa-edit"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-danger" ng-click="hc.delete(hc.users[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-trash-o"></i>' +
                    '</button>';
            }
        }

        vm.edit = function (user) {
            // Edit some data and call server to make changes...
            // Then reload the data so that DT is refreshed
            var params = {
                defaults: {roles: vm.roles},
                inputs: user
            };

            modal.form(params).then(function (result) {
                user = result.inputs;
                user.$update().then(function () {
                    vm.dtInstance.reloadData(angular.noop, false);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        }

        vm.delete = function (user) {
            modal.confirmation(user.name).then(function (result) {
                // Delete some data and call server to make changes,
                // then reload the data so that DT is refreshed
                user.$delete().then(function () {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(result.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        }
    }
})();
