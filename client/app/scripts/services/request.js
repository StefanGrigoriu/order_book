angular.module('orderBookApp').factory('Request', function ($http, config) 
{
	var post = function(uri, data, success, error)
	{
		  $http.defaults.headers.common['Authorization'] = sessionStorage.getItem('authorization');
		var url = config.serverURL + uri;
		console.dir(url);
		$http({
			method: 'POST',
			url: url
			, data: data
		})
		.then(
			function(resp)
			{
				if(success)
					success(resp.data);
			}
			, function(resp)
			{
				if(error)
					error(resp.data);
			});
	}

	var get = function(uri, success, error)
	{
		  $http.defaults.headers.common['Authorization'] = sessionStorage.getItem('authorization');
		var url = config.serverURL + uri;
		$http.get(url).then(
			function(resp)
			{
				if(success)
					success(resp.data);
			}
			, function(resp)
			{
				if(error)
					error(resp.data);
			});
	}

	var put = function(uri, data, success, error)
	{
		  $http.defaults.headers.common['Authorization'] = sessionStorage.getItem('authorization');
		var url = config.serverURL + uri;
		$http.put(url, data).then(
			function(resp)
			{
				if(success)
					success(resp.data);
			}
			, function(resp)
			{
				if(error)
					error(resp.data);
			});
	};

	var doDelete = function(uri, success, error)
	{
		  $http.defaults.headers.common['Authorization'] = sessionStorage.getItem('authorization');
		var url = config.serverURL + uri;
		$http.delete(url).then(
			function(resp)
			{
				if(success)
					success(resp.data);
			}
			, function(resp)
			{
				if(error)
					error(resp.data);
			});
	};

	var putForm = function(uri, data, success, error)
	{
		 var options =  {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        };
 
            options.headers.Authorization = sessionStorage.getItem('authorization');

        $http.put(uri, data, options)
            .then(success
                , error);
	}


	return {
		get: get
		, post: post
		, put: put
		, delete: doDelete

		,putForm: putForm
	}
});