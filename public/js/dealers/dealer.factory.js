(function() {
    'use strict';

    angular
        .module('app')
        .factory('Dealer', Dealer);

    Dealer.$inject = ['$resource'];

    /* @ngInject */
    function Dealer($resource) {
        var resource = new $resource('dealer/:id', {id: '@id'}, {
            update: {
                method: 'PUT'
            }
        });

        return resource;
    }
})();
