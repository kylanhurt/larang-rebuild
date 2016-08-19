angular.module('dataGoMain')
    .controller('entitySubmissionController',function ($http, dataGoAPI, $scope, $state) {
    var vm = this;
    $scope.submitNewEntity = submitNewEntity;
    $scope.saveEntityInfo = saveEntityInfo;
    $scope.entitySubmitNameResponse = { };
    $scope.currentEntityId = false;
    
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
    
    function saveEntityInfo() {
        console.log('beginning of saveEntityInfo execution');
        if(!isFinite($scope.entitySubmitNameResponse.new_id)){
            return;
        } else {
            console.log('new_id is finite');
            var saveEntityData = false;
            saveEntityData = {
                'website': $scope.entityWebsite,
                'year_founded':$scope.entityYearFounded,
                'industry': $scope.entityIndustry,
                'location': $scope.entityCountryOrigin,
                'new_id': $scope.entitySubmitNameResponse.new_id
            }
            dataGoAPI.apiReq('entity/update', 'PUT', saveEntityData)
                .success(function(resp) {
                    console.log('saveEntityInfo success, response:', resp);
                    $state.transitionTo('view-entity');
                })
                .error(function(resp){
                    console.log('saveEntityInfo error, response:', resp)
                });
        }
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