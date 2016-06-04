(function() {
    'use strict';

    angular
        .module('app')
        .factory('Region', Region);

    Region.$inject = ['$resource'];

    /* @ngInject */
    function Region($resource) {
        var resource = new $resource('region/:id', {id: '@id'}, {
            update: {
                method: 'PUT'
            }
        });

        return resource;
    }
})();
