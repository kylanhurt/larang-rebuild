angular.module('dataGoMain')
    .controller('entityViewController',function ($scope) {
       $scope.entityPrettyUrl = $scope.entityName; 
       console.log('$scope.entityName is:', $scope.entityName);
    });