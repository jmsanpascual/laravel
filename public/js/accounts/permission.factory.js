(function() {
    'use strict';

    angular
        .module('app')
        .factory('Permission', Permission);

    Permission.$inject = ['$resource'];

    /* @ngInject */
    function Permission($resource) {
        var resource = new $resource('permission/:id', {id: '@id'});

        return resource;
    }
})();
