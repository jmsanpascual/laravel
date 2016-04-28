(function() {
    'use strict';

    angular
        .module('app')
        .controller('PermissionController', PermissionController);

    PermissionController.$inject = [];

    /* @ngInject */
    function PermissionController() {
        var vm = this;

        activate();

        function activate() {

        }
    }
})();
