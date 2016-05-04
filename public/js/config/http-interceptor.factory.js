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
            var errorMessage = 'Unknown error occured.';

            switch (response.status) {
                case 403:
                    errorMessage = 'Sorry, you have no permission.'
                    break;
                case 422:
                    errorMessage = buildErrorMessage(response.data);
                    break;
                default:
                    $log.error('Server Error:', response);
            }

            return $q.reject(errorMessage);

            // Concats the array of object errors returned by laravel
            function buildErrorMessage(errors) {
                var message = '';

                for (var field in errors) {
                    message += errors[field].pop();
                    message += '<br>';
                }

                return message;
            }
        }
    }
})();
