(function() {
    'use strict';

    angular
        .module('app')
        .config(configure);

    configure.$inject = [
        '$httpProvider'
    ];

    function configure($httpProvider) {
        $httpProvider.interceptors.push('httpInterceptor');
    }
})();
