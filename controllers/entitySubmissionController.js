angular.module('dataGoMain')
    .controller('entitySubmissionController',function ($http, dataGoAPI, $scope) {
    var vm = this;
    $scope.submitNewEntity = submitNewEntity;
    $scope.entitySubmitNameResponse = { };
    
    function submitNewEntity () {
        console.log('submitNewEntity executing');
        dataGoAPI.apiReq('entity/create?entityName=' + encodeURI($scope.entityName) + '&entityWebsite=' + encodeURI($scope.entityWebsite), 'GET')
         .success(function (response) {
                    if(response.code === 1) {
                        console.log('success');
                        $scope.entitySubmitNameResponse = response;
                    } else if(response.code === 0) {
                        $scope.entitySubmitNameResponse = response;
                        console.log('fail');
                    }
                })
                .error (function(response) {
                    console.log(response)
                })
    }
    
    function searchEntities ( wikiApiUrl ) {
        var url = wikiApiUrl + encodeURI($scope.entityName);        
        var req = {
            method: 'GET',
            url: url
        };
        return $http(req);
    }    
});