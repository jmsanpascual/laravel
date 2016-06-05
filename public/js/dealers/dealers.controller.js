(function() {
    'use strict';

    angular
        .module('app')
        .controller('DealersController', DealersController);

    DealersController.$inject = [
        '$scope',
        '$compile',
        '$cookies',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        'Dealer',
        'Courier',
        'modal',
        'toast'
    ];

    /* @ngInject */
    function DealersController($scope, $compile, $cookies, DTOptionsBuilder,
        DTColumnBuilder, Dealer, Courier, modal, toast) {

        var vm = this;
        var defaults = {};

        vm.dealers = {};
        vm.dtInstance = {};

        activate();

        function activate() {
            vm.dtOptions = DTOptionsBuilder
                .fromFnPromise(getDealers)
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
                        text: 'Add Dealer',
                        key: '1',
                        action: addDealer
                    }
                ]);

            vm.dtColumns = [
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('courier.name').withTitle('Courier'),
                DTColumnBuilder.newColumn('region.name').withTitle('Region'),
                DTColumnBuilder.newColumn('city').withTitle('City'),
                DTColumnBuilder.newColumn('province').withTitle('Province'),
                DTColumnBuilder.newColumn('contact_person').withTitle('Contact Person'),
                DTColumnBuilder.newColumn('contact_number').withTitle('Contact Number'),
                DTColumnBuilder.newColumn('address_line_1').withTitle('Address 1')
                    .notVisible(),
                DTColumnBuilder.newColumn('address_line_2').withTitle('Address 2')
                    .notVisible(),
                DTColumnBuilder.newColumn(null).withTitle('Actions')
                    .notSortable().renderWith(actionsHtml)
            ];

            Courier.query().$promise.then(function (couriers) {
                defaults.couriers = couriers;
            });

            function getDealers() {
                return Dealer.query().$promise;
            }

            function addDealer() {
                var params = {
                    templateUrl: 'dealer/create',
                    defaults: defaults,
                    inputs: {
                        courier_id: defaults.couriers[0].id
                    },
                    options: {
                        title: 'Create Dealer Information'
                    }
                };

                modal.form(params).then(function (result) {
                    // Instantiate a new dealer to be saved
                    var newDealer = new Dealer(result);

                    newDealer.$save(function (response) {
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
                vm.dealers[data.id] = data;
                return '<button class="btn btn-success" ng-click="dc.edit(dc.dealers[' + data.id + '])">' +
                    '   <i class="fa fa-edit"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-info" ng-click="dc.export(dc.dealers[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-print"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-danger" ng-click="dc.delete(dc.dealers[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-trash-o"></i>' +
                    '</button>';
            }
        }

        vm.edit = function (dealer) {
            var params = {
                templateUrl: 'dealer/' + dealer.id + '/edit',
                defaults: defaults,
                inputs: angular.copy(dealer),
                options: {
                    title: 'Edit Dealer Information'
                }
            };

            // Edit some data and call server to make changes,
            // then reload the data so that DT is refreshed
            modal.form(params).then(function (result) {
                // Get the instance of the user to be updated
                dealer = result;

                dealer.$update().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };

        vm.export = function (dealer) {
            Dealer.export(dealer).$promise.then(function (response) {
                window.open(response.downloadPath, '_blank' );
            }, function (errorMsg) {
                toast.error(errorMsg);
            });
        };

        vm.delete = function (dealer) {
            modal.confirmation(dealer.name).then(function () {
                // Delete some data and call server to make changes,
                // then reload the data so that DT is refreshed
                dealer.$delete().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };
    }
})();
