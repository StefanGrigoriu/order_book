angular.module('orderBookApp').factory('authService', function () 
{
	var temp = {
		isLoggedIn: false
	};

	return {
		temp: temp
	}
});