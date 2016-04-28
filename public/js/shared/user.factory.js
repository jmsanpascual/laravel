(function() {
    'use strict';

    angular
        .module('app')
        .factory('user', user);

    user.$inject = ['$resource'];

    /* @ngInject */
    function user($resource) {
        var resource = new $resource('user/:id', {id: '@id'}, {
            update: {
                method: 'PUT',
                transformRequest: updateTransformRequest
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
