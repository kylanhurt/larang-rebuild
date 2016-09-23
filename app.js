//currently empLog has no dependencies, it may also define the module that bootstraps the HTML page (ng-app)
angular.module("dataGoMain", ['ui.router', 'ngMessages', 'satellizer', 'countrySelect', 'smart-table', 'iso-3166-country-codes','jkAngularRatingStars'])
        .controller('mainCtrl', MainCtrl)
        .factory('dataGoAPI', dataGoAPI)
        .constant('apiUrl', 'http://localhost/api/')
        .config(function ($stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide, apiUrl) {
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
        .run(function ($rootScope, $state ) {        
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

function MainCtrl($scope, $rootScope, $state, $auth, dataGoAPI) {
    console.log('MainCtrl function');   
    getEntityIndex('created_at', 10, 'desc');
    
    //define function for getting latest / best / top rated / popular entities
    function getEntityIndex(criteria, count, order) {
        $scope.currentIndexes = {};
        dataGoAPI.apiReq('entity?criteria=' + encodeURI(criteria) + '&count=' + count + '&order=' + order, 'GET')
         .success(function (response) {
                    if(response.code === 1) {
                        console.log('getEntityindex success and response is: ' , response);
			var target = "http://"; //for removal of 'http://' from string
                        $scope.currentIndex = response;

                    } else if(response.code === 0) {

                        console.log('getEntityIndex fail');
                    }
                })
                .error (function(response) {
                    console.log(response)
                })            
    }    
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
