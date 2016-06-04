(function() {
    'use strict';

    angular
        .module('app')
        .controller('RegionController', RegionController);

    RegionController.$inject = [
        '$scope',
        '$compile',
        '$cookies',
        'DTOptionsBuilder',
        'DTColumnBuilder',
        'Region',
        'modal',
        'toast'
    ];

    /* @ngInject */
    function RegionController($scope, $compile, $cookies, DTOptionsBuilder,
        DTColumnBuilder, Region, modal, toast) {

        var vm = this;
;
        vm.regions = {};
        vm.dtInstance = {};
        vm.upload = {show: false}

        activate();

        function activate() {
            vm.dtOptions = DTOptionsBuilder
                .fromFnPromise(getRegions)
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
                        text: 'Add Region',
                        key: '1',
                        action: addRegion
                    }
                ]);

            vm.dtColumns = [
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('region_code').withTitle('Region Code'),
                DTColumnBuilder.newColumn(null).withTitle('Actions')
                    .notSortable().renderWith(actionsHtml)
            ];

            function getRegions() {
                return Region.query().$promise;
            }

            function addRegion() {
                var params = {
                    templateUrl: 'region/create',
                    options: {
                        title: 'Create Region Information'
                    }
                };

                modal.form(params).then(function (result) {
                    // Instantiate a new Region to be saved
                    var newRegion = new Region(result);

                    newRegion.$save(function (response) {
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
                vm.regions[data.id] = data;
                return '<button class="btn btn-success" ng-click="rc.edit(rc.regions[' + data.id + '])">' +
                    '   <i class="fa fa-edit"></i>' +
                    '</button>&nbsp;' +
                    '<button class="btn btn-danger" ng-click="rc.delete(rc.regions[' + data.id + '])" )"="">' +
                    '   <i class="fa fa-trash-o"></i>' +
                    '</button>';

            }
        }

        vm.edit = function (region) {
            var params = {
                templateUrl: 'region/' + region.id + '/edit',
                inputs: angular.copy(region),
                options: {
                    title: 'Edit Region Information'
                }
            };

            // Edit some data and call server to make changes,
            // then reload the data so that DT is refreshed
            modal.form(params).then(function (result) {
                // Get the instance of the user to be updated
                region = result;

                region.$update().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };

        vm.delete = function (region) {
            modal.confirmation(region.name).then(function () {
                // Delete some data and call server to make changes,
                // then reload the data so that DT is refreshed
                region.$delete().then(function (response) {
                    vm.dtInstance.reloadData(angular.noop, false);
                    toast.success(response.message);
                }, function (errorMsg) {
                    toast.error(errorMsg);
                });
            });
        };
    }
})();
