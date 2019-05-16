var hellscripts = angular.module('hellscripts',['ngRoute','ngCookies','ui.bootstrap']);
hellscripts.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
    // Home
    .when("/", {
        templateUrl: "www/modules/home/view/home.view.html",
        controller: "homeCtrl", 
        resolve: {
            projects: function(services){
                return services.get('projects',{});
            }
        }
    })

    .when("/explore/:id", {
        templateUrl: "www/modules/projects/view/details.view.html",
        controller: "detailsProjectCtrl",
        resolve: {
            project: function (services, $route) {
                console.log(services.get('projects',{id: $route.current.params.id}));
                return services.get('projects',{ id: $route.current.params.id});
            }
        }
    })

    .when("/users", {
        templateUrl: "www/modules/users/view/login.view.html",controller: "loginCtrl"})

    // Contact
    .when("/contact", {templateUrl: "www/modules/contact/view/contact.view.html", controller: "contactCtrl"})

    // else 404
    .otherwise("/", {templateUrl: "www/view/templates/404.view.html", controller: "404Ctrl"});
}]);
