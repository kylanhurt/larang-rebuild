//currently empLog has no dependencies, it may also define the module that bootstraps the HTML page (ng-app)
angular.module("dataGoMain", ['ngRoute', 'ui.router', 'satellizer', 'countrySelect'])
        .controller('mainCtrl', MainCtrl)
        .factory('dataGoAPI', dataGoAPI)
        .constant('apiUrl', 'http://localhost/api/')
        .config(function ($routeProvider, $stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide, apiUrl ) {
            function redirectWhenLoggedOut($q, $injector) {
                return {
                    responseError: function (rejection) {
                        var $state = $injector.get('$state');
                        var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];
                        angular.forEach(rejectionReasons, function (value, key) {
                            if (rejection.data.error === value) {
                                localStorage.removeItem('user');
                                $rootScope.authenticated = false;
                            }
                        });
                        return $q.reject(rejection);
                    }
                }
            }
            // Setup for the $httpInterceptor
            $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);
            $authProvider.loginUrl = apiUrl + 'authenticate';
            $stateProvider
                .state('home', {
                    url: '',
                    views:{
                        'main-cont': {
                            templateUrl: 'views/home.html'
                        }
                    },
                    controller: "WelcomeController",
                    data: {
                        stateName: 'home'
                    }                 
                    
                })
                .state('submit-new-entity', {
                    url: 'entity/new',
                    views: {
                        'main-cont': {
                            templateUrl: 'views/entity.new.html'
                        }
                    },
                    controller: 'entitySubmissionController'
                })
                .state('view-entity', {
                    url: 'entity/view/:entityName',
                    views: {
                        'main-cont': {
                            templateUrl: 'views/entity.view.html'
                        }
                    },
                    controller: 'entityViewController'
                })                
            ;
        })
        .run(function ($rootScope, $state) {
            $rootScope.currentState = $state;
            console.log($rootScope);
            //$rootScope.stateName =  $state.stateName;            

            //console.log('$rootScope', $rootScope);            
            //console.log(localStorage);
            if(localStorage.getItem('satellizer_token')) {
                $rootScope.authenticated = true;
                console.log('initial load, authenticated = true');
            }
            $rootScope.$on('$stateChangeStart', function (event, toState) {
                var user = JSON.parse(localStorage.getItem('user'));
                if (user) {
                    $rootScope.authenticated = true;
                    $rootScope.currentUser = user;
                }
            });
        })

function MainCtrl($scope, $rootScope, $state, $auth ) {

}

function dataGoAPI($http, apiUrl) {
    return {
        registerNewUser: function (data) {
            var url = apiUrl + 'user/register';
            var postData = data;
            console.log('url', url);
            var req = {
                method: 'POST',
                url: url,
                data: postData
            }
            return $http(req);
        },
        apiReq: function (endpoint, method, data) {
            var url = apiUrl + endpoint;
            var data = data;
            var req = {
                method: method,
                url: url,
                data: data
            }
            return $http(req);
        }
    }
}