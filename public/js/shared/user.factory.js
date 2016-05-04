(function() {
    'use strict';

    angular
        .module('app')
        .factory('User', User);

    User.$inject = ['$resource'];

    /* @ngInject */
    function User($resource) {
        var resource = new $resource('user/:id', {id: '@id'}, {
            update: {
                method: 'PUT',
                // Already solved in the server side
                // transformRequest: updateTransformRequest
            }
        });

        return resource;

        function updateTransformRequest(data, header) {
            // Make a copy of the requested data to isolate changes
            var request = angular.copy(data);
            request['role'] = undefined;
            return angular.toJson(request);
        }
    }
})();
