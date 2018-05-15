'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').controller('OrderStatusCtrl', function ($scope, authService, $location, dialogs, config, $http, Request) 
{
  $scope.dateOptions = {
    // dateDisabled: disabled,
    formatYear: 'YYYY-MM-DD',
    startingDay: 1
  };
   $scope.temp = {
      status_password: ''
      , status: ''
   };

   console.dir(moment().format('YYYY-MM-DD HH:mm:ss'));
   
   $scope.findOrder = function()
   {
         $scope.temp.status = '';
         var url = 'orders/verify/';
         if($scope.temp.status_password)
         {
            url += $scope.temp.status_password;
         }

         Request.get(url
            , function(data)
         {
            if(data)
            {
               if(data.data)
               {
                  $scope.temp.status = data.data.status;
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
