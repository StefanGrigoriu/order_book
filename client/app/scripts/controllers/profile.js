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
 		user: authService.temp.user
 	};

 	// update profile function
 	$scope.updateProfile = function()
 	{
 		Request.put('users/' + authService.temp.user.id_user
 			, $scope.temp.user
 			, function(data)
 			{
        	//200 == success
        	if(data && data.status == '200')
        	{
        		alert(data.message);
        		authService.temp.user = data.data;
        		$scope.temp.user = data.data;
          	 // sessionStorage.setItem('authorization','Basic ' + btoa($scope.temp.user.username + ':' + $scope.temp.user.password + ':' + $scope.temp.company_id));
          	// authService.temp.user = data.data;
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

 	// $scope.uploadFile = function(){
 	// 	var file = $scope.myFile;
 	// 	console.log('file is ' );
 	// 	console.dir(file);
 	// 	var uploadUrl = "/fileUpload";
 	// 	// fileUpload.uploadFileToUrl(file, uploadUrl);
 	// };

 });
