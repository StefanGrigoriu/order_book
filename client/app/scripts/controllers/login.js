'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').controller('LoginCtrl', function ($scope, $location, authService) 
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
  		authService.temp.isLoggedIn = true;
		$location.path('/dashboard');
  	};
});
