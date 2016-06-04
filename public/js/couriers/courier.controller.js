(function() {
    'use strict';

    angular
        .module('app')
        .controller('CourierController', CourierController);

    CourierController.$inject = [
        '$scope',
        '$compile',
        '$cookies',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        'Courier',
        'modal',
        'toast'
    ];

    /* @ngInject */
    function CourierController($scope, $compile, $cookies, DTOptionsBuilder,
        DTColumnBuilder, Courier, modal, toast) {

        var vm = this;

        vm.title = '';
        vm.couriers = {};
        vm.template = {};
        vm.dtInstance = {};
        vm.upload = {show: false};

        activate();

        function activate() {
            vm.dtOptions = DTOptionsBuilder
                .fromFnPromise(getCouriers)
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
                        text: 'Add Courier',
                        key: '1',
                        action: addCourier
                    },
                ]);

            vm.dtColumns = [
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('account_number').withTitle('Account No'),
                DTColumnBuilder.newColumn(null).withTitle('Actions')
                    .notSortable().renderWith(actionsHtml)
            ];

            function getCouriers() {
                return Courier.query().$promise;
            }

            function addCourier() {
                var params = {
                    templateUrl: 'courier/create',
                    options: {
                        title: 'Create Courier Information'
                    }
                };

                modal.form(params).then(function (result) {
                    // Instantiate a new Courier to be saved
                    var newCourier = new Courier(result);

                    newCourier.$save(function (response) {
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
                vm.couriers[data.id] = data;
                return '<button class="btn btn-success" ng-click="cc.edit(cc.couriers[' + data.id + '])">' +
                    '   <i class="fa fa-edit"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-info" ng-click="cc.addTemplate(cc.couriers[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-upload"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-danger" ng-click="cc.delete(cc.couriers[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-trash-o"></i>' +
                    '</button>';

            }
        }

        vm.edit = function (courier) {
            var params = {
                templateUrl: 'courier/' + courier.id + '/edit',
                inputs: angular.copy(courier),
                options: {
                    title: 'Edit Courier Information'
                }
            };

            // Edit some data and call server to make changes,
            // then reload the data so that DT is refreshed
            modal.form(params).then(function (result) {
                // Get the instance of the user to be updated
                courier = result;

                courier.$update().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };

        vm.addTemplate = function (courier) {
            vm.title = 'Upload Template for ' + courier.name;
            vm.template.courier_id = courier.id;
            vm.upload.show = true;
        };

        vm.uploadTemplate = function (template) {
            Courier.uploadTemplate(template).$promise.then(function (response) {
                vm.template = {}; // Reset the template variable
                vm.upload.show = false;
                toast.success(response.message);
            }, function (errorMsg) {
                toast.error(errorMsg);
            });
        };

        vm.delete = function (courier) {
            modal.confirmation(courier.name).then(function () {
                // Delete some data and call server to make changes,
                // then reload the data so that DT is refreshed
                courier.$delete().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };
    }
})();
