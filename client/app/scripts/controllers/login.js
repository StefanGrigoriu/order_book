'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp').controller('LoginCtrl'
   , function ($scope, $location, authService, $http, config, Request) 
   {
     console.dir(authService);
     if(authService.temp.isLoggedIn)
      $location.path('/dashboard');

    $scope.temp = {
      company_id: ''
      , username: ''
      , password: ''
    };

    $scope.login = function()
    {
      sessionStorage.setItem('authorization','Basic ' + btoa($scope.temp.username + ':' + $scope.temp.password + ':' + $scope.temp.company_id));
      var sData = {
        email: $scope.temp.username
        , password: $scope.temp.password
        , id_company: $scope.temp.company_id
      };

      Request.post('security/login'
        , sData
        , function(data)
        {
          if(data)
          {
            if(data.status == 200)
            {
              authService.temp.isLoggedIn = true;
              $location.path('/dashboard');
            }
            else
            {
              alert('User not found');
            }
          }
          //success
          console.dir(data);
        }
        , function(data)
        {
          //error
          console.dir(data)
        })

      console.dir($http.defaults.headers.common['Authorization']);
     //  var url = config.ServerURL + '/login';
     //  $http.post(url, {
     //   username: $scope.temp.username
     //   , password: $scope.temp.password
     //   , company_id: $scope.temp.company_id
     // }).then(function(success)
     // {
  			// // $browserStorage.set('authorization') = 'Basic ' + btoa($scope.temp.username + $scope.temp.password + ':' + $scope.temp.company_id);
  			// // $location.path('/dashboard');
     //    console.dir(success);
     //  }
     //  , function(error)
     //  {
     //    console.dir(error);
     //  });
		// $http.default.headers.authorization = 
  		// authService.temp.isLoggedIn = true;
		// $location.path('/dashboard');
 };
});
