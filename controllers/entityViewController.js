angular.module('dataGoMain')
    .controller('entityViewController',function ($scope, $stateParams, dataGoAPI) {
        $scope.entityPrettyUrl = $stateParams.entityName; 
        $scope.getEntityInfo = getEntityInfo;
        
        //start acquiring entity information
        getEntityInfo($scope.entityPrettyUrl)
        
        //at this point we need to get all of the relevant information about the entity
        function getEntityInfo() {
            $scope.currentEntity = {};
            dataGoAPI.apiReq('entity/show?entityPrettyUrl=' + encodeURI($scope.entityPrettyUrl), 'GET')
             .success(function (response) {
                        if(response.code === 1) {
                            console.log('success');
                   
                        } else if(response.code === 0) {

                            console.log('fail');
                        }
                    })
                    .error (function(response) {
                        console.log(response)
                    })            
        }

    })
    .run(function() { //I think this gets executed when this script first loads
        console.log('inside of entityViewController run function'); 
    });