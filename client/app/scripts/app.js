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
  , 'chart.js'
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
   .when('/order-status', {
    templateUrl: 'views/pages/order_status.html'
    , controller: 'OrderStatusCtrl'

  })
   .when('/profile', {
    templateUrl: 'views/pages/profile.html'
    , controller: 'ProfileCtrl'

  })
   .when('/audit', {
    templateUrl: 'views/pages/audit.html'
    , controller: 'AuditCtrl'
  })
   .when('/company-settings', {
    templateUrl: 'views/pages/company_settings.html'
    , controller: 'CompanySettingsCtrl'
  })
   .when('/add-user', {
    templateUrl: 'views/pages/add_user.html'
    , controller: 'AddUserCtrl'
  })
   .when('/api-doc', {
    templateUrl: 'views/pages/api_doc.html'
    , controller: 'ApiDocCtrl'
  })
   .when('/statistics', {
    templateUrl: 'views/pages/statistics.html'
    , controller: 'StatisticCtrl'
  })
   .otherwise({
    redirectTo: '/login'
  });


 });

 app.run(['$rootScope', '$location', 'authService', function($rootScope, $location, authService)
 { 
   var publicPages = ['/home', '/about', '/contact', 'login', '/dashboard', '/order-status', '/api-doc', '/statistics'];
   $rootScope.$on('$locationChangeStart', function(event)
   {
            // if(  $http.defaults.headers.common['Authorization'] = sessionStorage.getItem('authorization');)
            if(sessionStorage.getItem('authorization'))
            {
             authService.getTemp().isLoggedIn = true; 
             if(sessionStorage.getItem('user'))
             {
              authService.getTemp().user = JSON.parse(sessionStorage.getItem('user'));
            }
          }
          else if(!authService.getTemp().isLoggedIn)
          {
           if(publicPages.indexOf($location.path()) == -1)
           { 
            $location.path('/login');
          }
        } 
      });
 }]);
