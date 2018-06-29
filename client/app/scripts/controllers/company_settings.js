'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:CompanySettingsCtrl
 * @description
 * # CompanySettingsCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp')
 .controller('CompanySettingsCtrl', function ($scope, Request, $q, authService) 
 {

   $scope.temp = {
   	filters: {
   		company: ''
   	}
   	, objectList: []
    , companyObject: {}
  };

  $scope.save = function()
  {
    var url = 'company/' + authService.getTemp().user.id_company;
    var data = {
        config: JSON.stringify({
          headquarter: $scope.temp.companyObject
        })
    };

    Request.put(url
      , data
      , function(data)
      {
        console.dir(data);
        if(data)
        {
         if(data.data)
         {
          $scope.temp.objectList = data.data;
          $scope.temp.companyObject = (JSON.parse(data.data.config)).headquarter;
        }
      }
      console.dir(data);
    }
    , function(data)
    {
      console.dir(data);
    });
  
} 

$scope.load = function()
{

 var url = 'company/' + authService.getTemp().user.id_company;;

 Request.get(url
  , function(data)
  {
    console.dir(data);
    if(data)
    {
     if(data.data)
     {
      $scope.temp.objectList = data.data;

      var config = (JSON.parse(data.data.config)).headquarter;
    
 $scope.temp.companyObject = {
          address_name: config.address_name ? config.address_name : ''
          , address_lat: config.address_lat ? config.address_lat : ''
          , address_lng: config.address_lng ? config.address_lng : ''
          , email: config.email ? config.email : ''
          , mobile_no: config.mobile_no ? config.mobile_no : ''
        };
    
      console.dir($scope.temp);
    }
  }
  console.dir(data);
}
, function(data)
{
  console.dir(data);
});
};

$scope.load();



$scope.getAddress = function(query)
{
  var request = {
    input: query
  };
  var deffered = $q.defer();
  console.dir(google);
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
  $scope.temp.companyObject.address_name = location.description;
  console.dir(location);
  var geocoder = new google.maps.Geocoder;
  geocoder.geocode({'placeId': location.place_id}
    , function(result, status)
    {

        $scope.temp.companyObject.address_lat = result[0].geometry.location.lat();
        $scope.temp.companyObject.address_lng = result[0].geometry.location.lng();

      });

};

});
