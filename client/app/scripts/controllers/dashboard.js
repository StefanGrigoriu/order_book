'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').controller('DashboardCtrl', function ($scope, authService, $location, dialogs) 
{
	// 	if(!authService.temp.isLoggedIn)
	// 	$location.path('/');
	// console.dir('hello');
   $scope.temp = {
   	objectList: [
   	{id_order: 1,  description:'Aenean pretium est at justo finibus, in varius mauris finibus.'}
   	,{id_order: 2, description: 'Mauris eu nulla in odio sagittis consequat id et nibh.'}
   	,{id_order: 3, description: 'Donec tincidunt sapien id elit egestas mollis.'}
   	,{id_order: 4, description: 'Vestibulum lacinia lectus nec dui suscipit efficitur.'}
   	,{id_order: 5, description: 'Sed maximus ipsum sed turpis pharetra, at molestie metus congue.'}
   	,{id_order: 6, description: 'Suspendisse a leo molestie, tincidunt massa vitae, sodales sem.'}
   	,{id_order: 7, description: 'Aliquam quis nisl placerat urna placerat sodales mattis imperdiet dolor.'}
   	,{id_order: 8, description: 'Sed quis leo suscipit, hendrerit metus id, volutpat nisl.'}
   	,{id_order: 9, description: 'Duis sed neque dictum, molestie orci ac, rutrum orci.'}
   	,{id_order: 10, description: 'Nulla rhoncus nulla id dolor sagittis dignissim.'}
   	,{id_order: 11, description: 'Praesent non lacus sollicitudin, efficitur arcu in, blandit nunc.'}
   	,{id_order: 12, description: 'Aenean non ipsum id nulla euismod tempus a sed urna.'}
   	,{id_order: 13, description: 'Suspendisse eu erat id erat mattis lacinia.'}
   	]
   	, filters: {}
   };

   $scope.editOrder = function(order)
   {
   	// dialogs.notify(order.id_order, order.description);
	dialogs.create('./views/partials/edit_order.html','EditOrderCtrl', order,{},'ctrl');
	console.dir(order);
   };

   $scope.removeOrder = function(order, key)
   {
   	console.dir(order);
   	var dlg = dialogs.confirm('Delete', 'Are you sure that you want to remove order number: '+ order.id_order);
   	dlg.result.then(function()
   	{
   		$scope.temp.objectList.splice(key, 1);
   		console.dir('yes');
   	}
   	, function()
   	{
   		console.dir('no');
   	});
   }

});
