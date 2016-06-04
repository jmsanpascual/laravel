(function() {
    'use strict';

    angular
        .module('app')
        .directive('fileModel', fileModel);

    fileModel.$inject = ['$parse'];

    /* @ngInject */
    function fileModel($parse) {
        var directive = {
            restrict: 'A',
            link: linkFunc
        };

        return directive;

        function linkFunc(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    }
})();
