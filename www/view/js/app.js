var hellscripts = angular.module('hellscripts',['ngRoute']);
hellscripts.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
        // Home
        .when("/", {templateUrl: "www/view/templates/main.view.html", controller: "mainCtrl"})

        // Contact
        .when("/contact", {templateUrl: "www/view/templates/contact.view.html", controller: "contactCtrl"})

        // else 404
        .otherwise("/", {templateUrl: "www/view/templates/main.view.html", controller: "mainCtrl"});
    }]);
