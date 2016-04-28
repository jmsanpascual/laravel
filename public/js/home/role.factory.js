(function() {
    'use strict';

    angular
        .module('app')
        .factory('role', role);

    role.$inject = ['$resource'];

    /* @ngInject */
    function role($resource) {
        var resource = new $resource('role/:id', {id: '@id'});

        return resource;
    }
})();
