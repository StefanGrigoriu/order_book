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
     if(authService.getTemp().isLoggedIn)
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
            console.dir(data);
            if(data.status && data.status  == 200)
            {
              authService.getTemp().isLoggedIn = true;
              authService.getTemp().user = data.data;
              sessionStorage.setItem('user',JSON.stringify(data.data));
              $location.path('/dashboard');
            }
            else
            {
              alert('User not found');
              sessionStorage.setItem('user', '');
              sessionStorage.setItem('authorization', '');
            }
          }
          //success
          console.dir(data);
        }
        , function(data)
        {
          alert('User not found');
          sessionStorage.setItem('user', '');
          sessionStorage.setItem('authorization', '');
        })
 };
});
