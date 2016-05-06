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
            resolve: {
                options: angular.noop,
                defaults: angular.noop,
                inputs: angular.noop
            }
        };

        return modal;

        function confirmation(name) {
            config.templateUrl = 'js/shared/confirmation-modal.html';
            config.resolve.options = callback({
                title: 'Delete Confirmation',
                name: name
            });

            return $uibModal.open(config).result;
        }

        function form(params) {
            config.templateUrl = params.templateUrl;
            config.resolve.defaults = callback(params.defaults);
            config.resolve.inputs = callback(params.inputs);
            config.resolve.options = callback (params.options);

            return $uibModal.open(config).result;
        }

        function callback(object) {
            return function () {
                return object || {};
            };
        }
    }
})();
