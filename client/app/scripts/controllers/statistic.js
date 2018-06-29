'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:StatisticCtrl
 * @description
 * # StatisticCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp')
 .controller('StatisticCtrl', function ($scope, Request) 
 {
  
//chart1, orders per motnh
//chart2, order per user
$scope.statistic = [
{
  data: [0, 0, 0, 0, 0, 0, 0, 0, 0 ,0 ,0 ,0]
  , series: ['Orders']
  , labels:['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'Octomber', 'November', 'December']
}
,{
  data: []

  , labels: []
}];

$scope.load = function()
{

 var url = 'orders/statistic';

     Request.get(url
      , function(data)
      {
        if(data)
        {
         if(data && data['chart1'].length)
         {
          angular.forEach(data['chart1'], function(value)
          {

            $scope.statistic[0].data[moment(value.created_at).format('M') - 1] = value.Total;
          });
         }
         if(data && data.chart2.length)
         {
          angular.forEach(data.chart2, function(value)
          {
            $scope.statistic[1].data.push(value.TOTAL);
             $scope.statistic[1].labels.push(value.name);
          });
         }
          console.dir( $scope.statistic[0].data);
        }
      console.dir(data);
    }
    , function(data)
    {
      console.dir(data);
    });
};

$scope.load();

});
