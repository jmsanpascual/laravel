(function() {
    'use strict';

    angular
        .module('app')
        .factory('modal', modal);

    modal.$inject = ['$uibModal'];

    /* @ngInject */
    function modal($uibModal) {
        var modal = {
            confirmation: confirmation,
            form: form
        };
        var config = {
            controller: 'ModalInstanceController',
            controllerAs: 'vm',
            size: 'md',
            resolve: {options: angular.noop}
        };

        return modal;

        function confirmation(name) {
            config.templateUrl = 'js/shared/confirmation-modal.html';
            config.resolve.options = callback({
                title: 'Delete Confirmation',
                name: name,
                message: name + ' was successfully deleted.'
            });

            return $uibModal.open(config).result;
        }

        function form(params) {
            config.templateUrl = 'js/shared/form-modal.html';
            config.resolve.defaults = callback(params.defaults);
            config.resolve.inputs = callback(params.inputs);
            config.resolve.options = callback ({
                title: 'Account Information'
                // message: name + ' was successfully added.'
            });

            return $uibModal.open(config).result;
        }

        function callback(object) {
            return function () {
                return object || {};
            };
        }
    }
})();
