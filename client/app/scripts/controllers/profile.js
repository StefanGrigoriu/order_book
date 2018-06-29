'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp')
 .controller('ProfileCtrl', function (authService, $scope, Request) 
 {

 	$scope.temp = {
 		user: authService.getTemp().user
 	};

 	// update profile function
 	$scope.updateProfile = function()
 	{
 		 Request.put('users/' + authService.getTemp().user.id_user
 		 	, $scope.temp.user
 		 	, function(resp)
 		 	{
        	//200 == success
        	if(resp && resp.status == '200')
        	{
        		alert(resp.message);
        		authService.updateUser(resp.data);
        		sessionStorage.setItem('user',JSON.stringify(resp.data));
        		$scope.temp.user = authService.getTemp().user;
        	}
        	else
        	{
        		alert("Profile could not be updated");
        	}
          //success

      }
      , function(data)
      {
      	alert("Profile could not be updated");
      });
	};

 });
