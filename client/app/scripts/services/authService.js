angular.module('orderBookApp').factory('authService', function () 
{
	var temp = {
		isLoggedIn: false
		, user: null
	};

	return {
		getTemp: function()
		{
			return temp;
		}
		, updateUser: function(userData)
		{
			temp.user = null;
			temp.user = userData;
		}
	}
});