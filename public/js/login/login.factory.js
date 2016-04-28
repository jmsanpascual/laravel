(function() {
    'use strict';

    angular
        .module('app')
        .factory('auth', auth);

    auth.$inject = ['$http'];

    /* @ngInject */
    function auth($http) {
        var auth = {
            login: login
        };

        return auth;

        function login(credentials) {
            return $http.post('login', credentials).then(success);

            function success(response) {
                return response.data;
            }
        }
    }
})();
