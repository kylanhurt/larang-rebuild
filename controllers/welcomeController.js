angular.module('dataGoMain')
    .controller('WelcomeController', ['$scope', '$http', 'dataGoAPI', '$rootScope',function($scope, $http, dataGoAPI, $rootScope){
        console.log('in HomeCtrl');
        $scope.registerUser = registerUser;
        $scope.loginEmail = '';
        $scope.loginPassword = '';
        $scope.registrationError = {"username" : false};

        function registerUser() {
            console.log('inside registerUser within welcomeController.js')
            var data = {email: $scope.email, password: $scope.password}
            dataGoAPI.registerNewUser(data)
                .success(function (response) {
                    if(response.code === 1) {
                        $rootScope.login($scope.email,$scope.password);
                    } else if(response.code === 0) {
                        $scope.registrationError.username = response.message;
                    }
                })
                .error (function(response) {
                    console.log(response)
                })
        }       
    }]);            


