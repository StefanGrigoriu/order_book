'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AddUserCtrl
 * @description
 * # AddUserCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp')
 .controller('AddUserCtrl', function ($scope, Request) 
 {
  
   $scope.temp = {
   	filters: {
   		company: ''
   	}
   	, objectList: []
   };

   $scope.load = function()
   {

     var url = 'audit';

     Request.get(url
      , function(data)
      {
        if(data)
        {
         if(data.data)
         {
          $scope.temp.objectList = data.data;
        }
      }
      console.dir(data);
    }
    , function(data)
    {
      console.dir(data);
    });
   };

 });
