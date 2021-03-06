'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp').controller('DashboardCtrl', function ($scope, authService, $location, dialogs, config, $http, Request) 
{
  $scope.dateOptions = {
    // dateDisabled: disabled,
    formatYear: 'YYYY-MM-DD',
    startingDay: 1
  };
   $scope.temp = {
   	objectList: [
   	{id_order: 1,  description:'Aenean pretium est at justo finibus, in varius mauris finibus.', client_name: 'Samy'}
   	,{id_order: 2, description: 'Mauris eu nulla in odio sagittis consequat id et nibh.', client_name: 'Stefan'}
   	,{id_order: 3, description: 'Donec tincidunt sapien id elit egestas mollis.', client_name: 'Catalin'}
   	,{id_order: 4, description: 'Vestibulum lacinia lectus nec dui suscipit efficitur.', client_name: 'Adrian'}
   	,{id_order: 5, description: 'Sed maximus ipsum sed turpis pharetra, at molestie metus congue.', client_name: 'Adam'}
   	,{id_order: 6, description: 'Suspendisse a leo molestie, tincidunt massa vitae, sodales sem.', client_name: 'Eva'}
   	,{id_order: 7, description: 'Aliquam quis nisl placerat urna placerat sodales mattis imperdiet dolor.', client_name: 'Ciupica'}
   	,{id_order: 8, description: 'Sed quis leo suscipit, hendrerit metus id, volutpat nisl.', client_name: 'Traian'}
   	,{id_order: 9, description: 'Duis sed neque dictum, molestie orci ac, rutrum orci.', client_name: 'Mihai'}
   	,{id_order: 10, description: 'Nulla rhoncus nulla id dolor sagittis dignissim.', client_name: 'Daniel'}
   	,{id_order: 11, description: 'Praesent non lacus sollicitudin, efficitur arcu in, blandit nunc.', client_name: 'Tata'}
   	,{id_order: 12, description: 'Aenean non ipsum id nulla euismod tempus a sed urna.', client_name: 'Oloi Claudiu'}
   	,{id_order: 13, description: 'Suspendisse eu erat id erat mattis lacinia.', client_name: 'Cioanu Cristian'}
   	]
   	, filters: {
         description: ''
         , client_name: ''
         , id_order: ''
         , date:''
      }
   };

   console.dir(moment().format('YYYY-MM-DD HH:mm:ss'));
   
   $scope.load = function()
   {

         var url = 'orders';
         var q = false;
         var queryString = [];
         angular.forEach($scope.temp.filters, function(key, value)
         {
            if($scope.temp.filters[value])
            {
               queryString.push({
                  value: value == 'date_to' ? moment(moment($scope.temp.filters[value]).endOf('day')).format('YYYY-MM-DD HH:mm:ss') : 
                  value == 'date_from' ? moment(moment($scope.temp.filters[value]).startOf('day')).format('YYYY-MM-DD HH:mm:ss') : $scope.temp.filters[value] 
                  , key: value == 'date_to' || value == 'date_from' ? 'created_at' : value
                  , op: value == 'client_name' || value == 'description' ? 'LIKE' : value == 'date_to' ? '<=' : value == 'date_from' ? '>=' : '='
               });

               if(!q) q = true;
            }
         });    
         if(q) 
            url += '?q=' + JSON.stringify(queryString);

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
   $scope.load();

   $scope.addNew = function()
   {
      var dlg = dialogs.create('./views/partials/edit_order.html','EditOrderCtrl', null,{size:'lg'},'ctrl');
      dlg.result.then(function(data)
      {
         Request.post('orders' 
            , {
               'Orders': {
                  'description' : data.description
                  , 'client_name': data.client_name
                  , 'client_email': data.client_email
                  , 'destination_address': data.destination_address
                  , 'destination_lng': data.destination_lng
                  , 'destination_lat': data.destination_lat
                  , 'duration': data.duration
                  , 'distance': data.distance
                  , duration_text: data.duration_text
                  , distance_text: data.distance_text
               }
            }
            , function(resp)
         {
            //succes
            console.dir(resp);
            if(resp && resp.response)
            {

              //In case he closes with save button
                         $scope.temp.objectList.push(resp.response);
            }

         }
         , function(resp)
         {
            console.dir(resp);
               //eror
         });
       
      }
      , function()
      {
         //In case he closes without saving
      });
   }

   $scope.editOrder = function(order, key)
   {

	 var dlg = dialogs.create('./views/partials/edit_order.html','EditOrderCtrl', order,{keyboard:false, size:"xlg"});
     dlg.result.then(function(data)
      {
          Request.put('orders/'+ order.id_order 
            , {
               'Orders': {
                  'description' : data.description
                  , 'client_name': data.client_name
                    , 'client_email': data.client_email
                  , status: data.status
                  , status_password: data.status_password
                   , 'destination_address': data.destination_address
                  , 'destination_lng': data.destination_lng
                  , 'destination_lat': data.destination_lat
                  , 'duration': data.duration
                  , 'distance': data.distance
                  , duration_text: data.duration_text
                  , distance_text: data.distance_text
               }
            }
            , function(resp)
         {
            if(resp && resp.response)
            {

              //In case he closes with save button
               $scope.temp.objectList.splice(key,1);
               $scope.temp.objectList.splice(key,0, resp.response);
            }

         }
         , function(resp)
         {
            console.dir(resp);
               //eror
         });
      
      }
      , function()
      {
         //In case he closes without saving
      });
   };

   $scope.removeOrder = function(order, key)
   {
   	console.dir(order);
   	var dlg = dialogs.confirm('Delete', 'Are you sure that you want to remove order number: '+ order.id_order);
   	dlg.result.then(function()
   	{
         Request.delete('orders/'+ order.id_order, function(resp)
         {
            //success
            console.dir(resp);
                  $scope.temp.objectList.splice(key, 1);
         }
         , function(resp)
         {
            // error
         })
  
   		console.dir('yes');
   	}
   	, function()
   	{
   		console.dir('no');
   	});
   }

});
