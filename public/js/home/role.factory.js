(function() {
    'use strict';

    angular
        .module('app')
        .factory('Role', Role);

    Role.$inject = ['$resource'];

    /* @ngInject */
    function Role($resource) {
        var resource = new $resource('role/:id', {id: '@id'});

        return resource;
    }
})();
