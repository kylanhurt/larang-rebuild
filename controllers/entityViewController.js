angular.module('dataGoMain')
    .controller('entityViewController',function ($scope, $stateParams, dataGoAPI, $rootScope) {
        $scope.entityPrettyUrl = $stateParams.entityName; 
        $scope.getEntityInfo = getEntityInfo;
        $scope.onRating = onRating;
        $scope.range = range;
        
        //start acquiring entity information
        getEntityInfo($scope.entityPrettyUrl);
        
        //at this point we need to get all of the relevant information about the entity
        function getEntityInfo() {
            $scope.currentEntity = {};
            dataGoAPI.apiReq('entity/show?entityPrettyUrl=' + encodeURI($scope.entityPrettyUrl), 'GET')
             .success(function (response) {
                        if(response.code === 1) {
                            console.log('getEntityInfo success and response is: ' , response);
                            $scope.currentEntity = response;
                   
                        } else if(response.code === 0) {

                            console.log('fail');
                        }
                    })
                    .error (function(response) {
                        console.log(response)
                    })            
        }
        
        function onRating(newRating) {
            console.log('inside of onRating and the rating is: ', newRating);
            var data = {
                'score': newRating,
                'pretty_url': $scope.currentEntity.pretty_url, //to identify entity id
                'user_email': $rootScope.currentUser.email, //to idenity user id
                'criteria': 'general'
            }
            dataGoAPI.apiReq('review', 'POST', data)
             .success(function (response) {
                        if(response.code === 1) {
                            console.log('submit review success and response is: ' , response);

                        } else if(response.code === 0) {

                            console.log('fail');
                        }
                    })
                    .error (function(response) {
                        console.log(response)
                    })                 
        }
        
        function range (min, max, step) {
            step = step || 1;
            var input = [];
            for (var i = min; i <= max; i += step) {
                input.push(i);
            }
            return input;
        };        

    })
    .run(function() { //I think this gets executed when this script first loads
        console.log('inside of entityViewController run function'); 
    });