(function() {
    'use strict';

    angular
        .module('app')
        .factory('country', country);

    country.$inject = ['$resource'];

    /* @ngInject */
    function country($resource) {
        var resource = new $resource('country/:id', {id: '@id'});

        return resource;
    }
})();
