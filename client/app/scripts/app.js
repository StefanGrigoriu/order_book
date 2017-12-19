'use strict';

/**
 * @ngdoc overview
 * @name orderBookApp
 * @description
 * # orderBookApp
 *
 * Main module of the application.
 */
angular
  .module('orderBookApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider, $locationProvider) 
  {
     $locationProvider.hashPrefix('');
    $routeProvider
      .when('/home', {
        templateUrl: 'views/pages/home.html'
        , controller: 'HomeCtrl'
      })
      .when('/about', {
        templateUrl: 'views/pages/about.html'
        , controller: 'AboutCtrl'
      })
       .when('/contact', {
        templateUrl: 'views/pages/contact.html'
        , controller: 'ContactCtrl'
      })
        .when('/login', {
        templateUrl: 'views/pages/login.html'
        , controller: 'LoginCtrl'
      })
      .when('/dashboard', {
        templateUrl: 'views/pages/dashboard.html'
        , controller: 'DashboardCtrl'
      })
      .otherwise({
        redirectTo: '/login'
      });
  });
