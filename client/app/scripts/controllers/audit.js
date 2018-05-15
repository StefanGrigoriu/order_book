'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the orderBookApp
 */
angular.module('orderBookApp')
  .controller('AuditCtrl', function ($scope, Request) 
  {

   $scope.temp = {
   	filters: {
   		company: ''
   	}
   	, objectList: []
   };

   $scope.jsonHighlight = function(input, autoIndent)
   {
   	try {
            var json = JSON.parse(input);

            if (typeof json !== 'string') {
                json = JSON.stringify(json, undefined, 2);
            }
            json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            });
        }
        catch(err) {
            return input;
        }
    };

     $scope.load = function()
   {

         var url = 'audit';
         // var q = false;
         // var queryString = [];
         // angular.forEach($scope.temp.filters, function(key, value)
         // {
         //    if($scope.temp.filters[value])
         //    {
         //       queryString.push({
         //          value: value == 'date_to' ? moment(moment($scope.temp.filters[value]).endOf('day')).format('YYYY-MM-DD HH:mm:ss') : 
         //          value == 'date_from' ? moment(moment($scope.temp.filters[value]).startOf('day')).format('YYYY-MM-DD HH:mm:ss') : $scope.temp.filters[value] 
         //          , key: value == 'date_to' || value == 'date_from' ? 'created_at' : value
         //          , op: value == 'client_name' || value == 'description' ? 'LIKE' : value == 'date_to' ? '<=' : value == 'date_from' ? '>=' : '='
         //       });

         //       if(!q) q = true;
         //    }
         // });    
         // if(q) 
         //    url += '?q=' + JSON.stringify(queryString);

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
  });
