angular.module('dataGoMain')
    .controller('entitySubmissionController',function ($http, dataGoAPI, $scope, $state, $location, $route) {
    var vm = this;
    $scope.pretty_url = false;
    $scope.submitNewEntity = submitNewEntity;
    $scope.saveEntityInfo = saveEntityInfo;
    $scope.entitySubmitNameResponse = { };
    $scope.currentEntityId = false;
    
    function submitNewEntity () {
        console.log('submitNewEntity executing');
        dataGoAPI.apiReq('entity/create?entityName=' + encodeURI($scope.entityName), 'GET')
         .success(function (response) {
                    if(response.code === 1) {
                        console.log('success');
                        $scope.entitySubmitNameResponse = response;
                        $scope.pretty_url = response.pretty_url;                        
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
                    console.log('saveEntityInfo success, response:', resp, '$scope.pretty_url is', $scope.pretty_url);
                    $state.transitionTo('view-entity',  {'entityName': $scope.pretty_url});
                    $location.path('/entity/view/' + $scope.pretty_url);
                    $route.reload();
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