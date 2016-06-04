(function() {
    'use strict';

    angular
        .module('app')
        .factory('Courier', Courier);

    Courier.$inject = ['$resource'];

    /* @ngInject */
    function Courier($resource) {
        var resource = new $resource('courier/:id', {id: '@id'}, {
            update: {
                method: 'PUT'
            },
            uploadTemplate: {
                url: 'courier/upload-template',
                method: 'POST',
                transformRequest: transformRequest,
                headers: {
                    'Content-Type': undefined
                }
            }
        });

        return resource;

        function transformRequest(data) {
            if (data === undefined) return data;

            var fd = new FormData();

            angular.forEach(data, function(value, key) {
                if (value instanceof FileList) {
                    if (value.length == 1) {
                        fd.append(key, value[0]);
                    } else {
                        angular.forEach(value, function(file, index) {
                            fd.append(key + '_' + index, file);
                        });
                    }
                } else {
                    fd.append(key, value);
                }
            });

            return fd;
        }
    }
})();
