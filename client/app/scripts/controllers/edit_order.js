'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp').controller('EditOrderCtrl', function ($scope, data, $q, authService, Request, $timeout) 
 {
 	$scope.companyObject = {};
 	$scope.routeInfo = {
 		distance: ''
 		, duration: ''
 	};


 	var initMap = function() 
 	{
 		
 		var latlng = new google.maps.LatLng(47.151726, 27.587914);
 		var myOptions = {
 			zoom: 8,
 			center: latlng,
 			mapTypeId: google.maps.MapTypeId.ROADMAP
 		};
 		map = document.getElementById("map");

 		map = new google.maps.Map(map, myOptions);

 		if($scope.ceva.destination_lat && $scope.ceva.destination_lat)
 		{
 			var marker = new google.maps.Marker({
 				position: new google.maps.LatLng($scope.ceva.destination_lat, $scope.ceva.destination_lng)
 				, draggable: false
 				, map: map
 				, title: 'Destination'
 			});
 			markers.push(marker);
 		}
 	};

 	var createNew = function()
 	{
 		return {
 			is_new: true
 			, description: ''
 		}
 	};
 	var map = null;   
 	var markers = [];
 	$scope.ceva = data ? data : createNew();

 	$scope.loadConfig = function()
 	{
			console.dir(authService.getTemp());
 		var url = 'company/' + authService.getTemp().user.id_company;;

 		Request.get(url
 			, function(data)
 			{
 				if(data)
 				{
 					if(data.data)
 					{
 						// $scope.temp.objectList = data.data;

 						var config = (JSON.parse(data.data.config)).headquarter;

 						$scope.companyObject = {
 							address_name: config.address_name ? config.address_name : ''
 							, address_lat: config.address_lat ? config.address_lat : ''
 							, address_lng: config.address_lng ? config.address_lng : ''
 							, email: config.email ? config.email : ''
 							, mobile_no: config.mobile_no ? config.mobile_no : ''
 						};
 						
 					}
 				}
 			}
 			, function(data)
 			{
 				console.dir(data);
 			});
 	}();




 	

 	setTimeout(function()
 	{
 		initMap();
 	}, 500);


 	$scope.getAddress = function(query)
 	{
 		var request = {
 			input: query
 		};
 		var deffered = $q.defer();

 		var service = new google.maps.places.AutocompleteService();
 		service.getPlacePredictions(request
 			, function(prediction, status)
 			{
 				if(status != google.maps.places.PlacesServiceStatus.OK)
 					return;
 				else
 					deffered.resolve(prediction);
 			});
 		return deffered.promise;
 	};



 	$scope.changeDestination = function(location)
 	{
 		$scope.ceva.destination_address = location.description;

 		var geocoder = new google.maps.Geocoder;
 		geocoder.geocode({'placeId': location.place_id}
 			, function(result, status)
 			{
 				if(markers[0])
 				{
 					markers[0].setMap(null);
 					markers = [];
 				}

 				$scope.ceva.destination_lat = result[0].geometry.location.lat();
 				$scope.ceva.destination_lng = result[0].geometry.location.lng();
 				var objecMarkertCoordinates = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());
 				var marker = new google.maps.Marker({
 					position: objecMarkertCoordinates
 					, draggable: false
 					, map: map
 					, title: 'Destination'
 				});
 				map.panTo(objecMarkertCoordinates);
 				markers.push(marker);
 				
 				$scope.calculateDistance();
 			});



 	};



 	$scope.calculateDistance = function()
 	{
 		var origin1 = new google.maps.LatLng($scope.companyObject.address_lat, $scope.companyObject.address_lng);

 		var destinationB = new google.maps.LatLng($scope.ceva.destination_lat, $scope.ceva.destination_lng);

 		var service = new google.maps.DistanceMatrixService();
 		service.getDistanceMatrix(
 		{
 			origins: [origin1],
 			destinations: [destinationB],
 			travelMode: 'DRIVING'
 		}
 		, function(resp, status)
 		{
 			if(resp && resp.rows && resp.rows[0] && resp.rows[0].elements && resp.rows[0].elements[0] && resp.rows[0].elements[0].distance)
 			{

 				$timeout(function()
 				{
 					$scope.ceva.distance_text = angular.copy(resp.rows[0].elements[0].distance.text);
 					$scope.ceva.duration_text = angular.copy(resp.rows[0].elements[0].duration.text);
 					$scope.ceva.distance = angular.copy(resp.rows[0].elements[0].distance.value);
 					$scope.ceva.durations = angular.copy(resp.rows[0].elements[0].duration.value);
 				}, 100);
 				
 			}

 		});
 		
 	};


 });
