angular.module('orderBookApp').factory('authService', function () 
{
	var temp = {
		isLoggedIn: false
		, user: null
	};

	return {
		temp: temp
	}
});