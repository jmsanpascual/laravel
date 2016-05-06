(function() {
    'use strict';

    angular
        .module('app')
        .controller('ModalInstanceController', ModalInstanceController);

    ModalInstanceController.$inject = [
        '$uibModalInstance',
        'options',
        'defaults',
        'inputs'
    ];

    /* @ngInject */
    function ModalInstanceController($uibModalInstance, options, defaults,
        inputs) {

        var vm = this;
        vm.options = options;
        vm.defaults = defaults;
        vm.inputs = inputs;

        vm.ok = function () {
            $uibModalInstance.close(vm.inputs);
        };

        vm.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }
})();
