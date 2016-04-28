(function() {
    'use strict';

    angular
        .module('app')
        .factory('httpInterceptor', httpInterceptor);

    httpInterceptor.$inject = ['$q', '$log'];

    /* @ngInject */
    function httpInterceptor($q, $log) {
        var interceptor = {
            response: response,
            responseError: responseError
        };

        return interceptor;

        function response(response) {
            var data = response.data;

            if (data && data.error) {
                return $q.reject(data.error);
            }

            return response;
        }

        function responseError(response) {
            $log.error('Server Error:', response);
            return $q.reject('Unknown error occured.');
        }
    }
})();
