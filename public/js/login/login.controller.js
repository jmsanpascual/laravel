(function() {
    'use strict';

    angular
        .module('app')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$window', 'auth', 'toast'];

    /* @ngInject */
    function LoginController($window, auth, toast) {
        var vm = this;

        vm.login = function (credentials) {
            auth.login(credentials).then(function (response) {
                $window.location.reload(true);
            }, function (errorMsg) {
                toast.error(errorMsg, true);
            });
        };
    }
})();
