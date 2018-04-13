'use strict';

/**
 * @ngdoc overview
 * @name orderBookApp
 * @description
 * # orderBookApp
 *
 * Main module of the application.
 */
var app = angular
  .module('orderBookApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
    , 'ui.bootstrap'
    , 'dialogs.main'
    , 'dialogs.default-translations'
  ])
  .config(function ($routeProvider, $locationProvider) 
  {
     $locationProvider.hashPrefix('');
    $routeProvider
      .when('/home', {
        templateUrl: 'views/pages/home.html'
        , controller: 'HomeCtrl'
        //home.js
      })
      .when('/about', {
        templateUrl: 'views/pages/about.html'
        , controller: 'AboutCtrl'
        //about.js
      })
       .when('/admin', {
        templateUrl: 'views/pages/admin.html'
        , controller: 'AdminCtrl'
        //contact.js
      })
        .when('/login', {
        templateUrl: 'views/pages/login.html'
        , controller: 'LoginCtrl'
        //login.js
      })
      .when('/dashboard', {
        templateUrl: 'views/pages/dashboard.html'
        , controller: 'DashboardCtrl'
        //dashboard.js
      })
      .otherwise({
        redirectTo: '/login'
      });

     
  });

  app.run(['$rootScope', '$location', 'authService', function($rootScope, $location, authService)
  { 
     var publicPages = ['/home', '/about', '/contact', 'login', '/dashboard'];
          $rootScope.$on('$locationChangeStart', function(event)
          {
            // if(  $http.defaults.headers.common['Authorization'] = sessionStorage.getItem('authorization');)
              if(sessionStorage.getItem('authorization'))
              {
               authService.temp.isLoggedIn = true; 
              }
              else if(!authService.temp.isLoggedIn)
              {
                 if(publicPages.indexOf($location.path()) == -1)
                { 
                    $location.path('/login');
                }
              } 
          });
  }]);
