'use strict';

/**
 * @ngdoc function
 * @name orderBookApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the orderBookApp
 */
 angular.module('orderBookApp')
 .controller('ApiDocCtrl', function ($scope) {
 	$scope.temp = {
 		requests: [
 		{
 			name:'VIEW ORDERS'
 			, method: 'GET'
 			, url: 'api-url/orders'
 			, params: [
 			{
 				text: ''
 				, required: false
 			}
 			]
 			, response: JSON.stringify({
 				"message": "All users list that have been requested",
 				"data": [
 				{
 					"id_order": "49",
 					"id_company": "2",
 					"id_user": "42",
 					"client_name": null,
 					"description": "Bla bla car, mocheta 2m",
 					"destination_address": "Șoseaua Moara de Foc, Iași, România",
 					"destination_lat": "47.1728196",
 					"destination_lng": "27.5551501",
 					"distance": "5916",
 					"duration": "850",
 					"distance_text": "5,9 km",
 					"duration_text": "14 min",
 					"status": null,
 					"status_password": null,
 					"created_at": "2018-05-20 11:44:43",
 					"updated_at": null
 				},
 				{
 					"id_order": "48",
 					"id_company": "2",
 					"id_user": "42",
 					"client_name": "Test with location",
 					"description": "Test",
 					"destination_address": "Cluj-Napoca, România",
 					"destination_lat": "46.7712101",
 					"destination_lng": "23.6236353",
 					"distance": null,
 					"duration": null,
 					"distance_text": null,
 					"duration_text": null,
 					"status": null,
 					"status_password": null,
 					"created_at": "2018-05-17 19:32:31",
 					"updated_at": null
 				}
 				]
 			})
 		}
 		,{
 			name:'VIEW A CERTAIN ORDER'
 			, method: 'GET'
 			, url: 'api-url/orders/{id}'
 			, params: JSON.stringify({
 				'Id': '49'
 				, 'description':"Is an integer"
 				, 'required': true
 			})
 			, response: JSON.stringify({
 				"message": "All users list that have been requested",
 				"data": [
 				{
 					"id_order": "49",
 					"id_company": "2",
 					"id_user": "42",
 					"client_name": null,
 					"description": "Bla bla car, mocheta 2m",
 					"destination_address": "Șoseaua Moara de Foc, Iași, România",
 					"destination_lat": "47.1728196",
 					"destination_lng": "27.5551501",
 					"distance": "5916",
 					"duration": "850",
 					"distance_text": "5,9 km",
 					"duration_text": "14 min",
 					"status": null,
 					"status_password": null,
 					"created_at": "2018-05-20 11:44:43",
 					"updated_at": null
 				}
 				]
 			})
 		}
 		, 
 		{
 			name:'ADD AN ORDER'
 			, method: 'POST'
 			, url: 'api-url/orders'
 			, params: JSON.stringify({
 				"Orders":{
 					"description":"Mobila din pal cu 3 piese",
 					"client_name":"Stefan test",
 					"id_user":"2"
 				}
 			})
 			, response: JSON.stringify({
 				"message": "The orders has been added.",
 				"data": [
 				{
 					"id_order": "50",
 					"id_company": "2",
 					"id_user": "2",
 					"client_name": null,
 					"description": "Mobila din pal cu 3 piese",
 					"destination_address": "",	
 					"destination_lat": "",
 					"destination_lng": "",
 					"distance": "",
 					"duration": "",
 					"distance_text": "",
 					"duration_text": "",
 					"status": null,
 					"status_password": null,
 					"created_at": "2018-05-20 11:44:43",
 					"updated_at": null
 				}
 				]
 			})
 		}
 		,
 		{
 			name:'DELETE AN ORDER'
 			, method: 'DELETE'
 			, url: 'api-url/orders/{id}'
 			, params: JSON.stringify({
 			
 			})
 			, response: JSON.stringify({
 				"message": "The orders has been deleted.",
 				"data": [
 				{
 					}
 				]
 			})
 		}
 		]
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

 });
