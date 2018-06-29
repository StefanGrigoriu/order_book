'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp')
 .controller('AdminCtrl', function ($scope, Request, $q, authService) 
 {
	$scope.auth = authService.getTemp();
	
 	$scope.temp = {
 		user:{
 			name: ''
 			, email: ''
 			, password: ''
 			, id_company: ''
 			, id_user_type: "3"
 		}
 		, company: {
 			name: ''
 			, config: ''
 		}
 		, companySearch: ''
 		, selected: false
 	};

 	if(authService.getTemp().user.id_user_type == '2')
 	{
 		$scope.temp.user.id_company = authService.getTemp().user.id_company;
 		$scope.temp.selected = true;
 	}
 	
 	$scope.createCompany = function()
 	{
 		Request.post('company' 
 			, $scope.temp.company
 			, function(resp)
 			{
	            //succes
	            console.dir(resp);
	            if(resp)
	            {
	            	$scope.temp = {
	            		user:{
	            			name: ''
	            			, email: ''
	            			, password: ''
	            			, id_company: ''
	            			, id_user_type: "3"
	            		}
	            		, company: {
	            			name: ''
	            			, config: ''
	            		}
	            		, companySearch: ''
	            		, selected: false
	            	};

	            		if(authService.getTemp().user.id_user_type == '2')
 	{
 		$scope.temp.user.id_company = authService.getTemp().user.id_company;
 		$scope.temp.selected = true;
 	}
	            	alert('Company has been added');
	            }
	        }
	        , function(resp)
	        {
	        	console.dir(resp);
               //eror
           });
 	}

 	$scope.createUser = function()
 	{
 		Request.post('users' 
 			, $scope.temp.user
 			, function(resp)
 			{
	            //succes
	            if(resp)
	            {
	            	$scope.temp = {
	            		user:{
	            			name: ''
	            			, email: ''
	            			, password: ''
	            			, id_company: ''
	            			, id_user_type: "3"
	            		}
	            		, company: {
	            			name: ''
	            			, config: ''
	            		}
	            		, companySearch: ''
	            		, selected: false
	            	};
	            		alert(resp.message);
	            }
	        }
	        , function(resp)
	        {
	        	console.dir(resp);
               //eror
           });
 	}

 	$scope.setCompany = function(par)
 	{
 		console.dir(par);
 		$scope.temp.user.id_company = par.id_company;
 	}

 	$scope.getCompany = function(par)
 	{
 		var promise = $q.defer();
 		var url = 'company?q=[{"key":"name", "op":"LIKE", "value": "'+ par +'"}]';
 		Request.get(url
 			, function(data)
 			{
 				if(data)
 				{
 					if(data.data)
 					{
 						promise.resolve(data.data);
 					}
 				}
 				console.dir(data);
 			}
 			, function(data)
 			{
 				console.dir(data);
 			});
 		return promise.promise;
 	};

 });
