'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').directive('appMenu', function () 
{ 
  return {
  	restrict: 'EA'
  	, templateUrl: './views/partials/app_menu.html'
  	, controller: function(authService, $scope, $location)
  	{
  		$scope.location = $location;
  		$scope.auth = authService.getTemp();
  		
  		$scope.logout = function()
  		{
  
			$scope.auth.isLoggedIn = false;
				authService.getTemp().isLoggedIn = false;
						
                    sessionStorage.clear();
			$location.path('/login');
  		};
  	}
  };
 });
