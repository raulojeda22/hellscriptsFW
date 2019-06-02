var hellscripts = angular.module('hellscripts',['ngRoute','ngCookies','ui.bootstrap','toastr']);
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

    // Explore
    .when("/explore/:id", {
        templateUrl: "www/modules/projects/view/details.view.html",
        controller: "detailsProjectCtrl",
        resolve: {
            project: function (services, $route) {
                return services.get('projects',{ id: $route.current.params.id});
            }
        }
    })

    .when("/users", {
        templateUrl: "www/modules/users/view/login.view.html",controller: "loginCtrl"})

    // Contact
    .when("/contact", {templateUrl: "www/modules/contact/view/contact.view.html", controller: "contactCtrl"})

    // Profile
    .when("/profile", {templateUrl: "www/modules/profile/view/profile.view.html", controller: "profileCtrl"})

    // Contact
    .when("/projects", {templateUrl: "www/modules/projects/view/projects.view.html", controller: "projectsCtrl"})

    .when("/recover/:email/:token", {
        templateUrl: "www/modules/password/view/changePassword.view.html", 
        controller: "passwordCtrl"
    })

    // else 404
    .otherwise("/", {templateUrl: "www/view/templates/404.view.html", controller: "404Ctrl"});
}]).run(function(services,$cookies,$rootScope,$window,loginService,toastr){
    $rootScope.loggedIn=false;
    object={id:$cookies.get('idUser')};
    services.get('users',object).then(function(response){
        $rootScope.user=response[0];
        if ($rootScope.user!=null){
            if ($rootScope.user.activated!=1){
                toastr.success('Please activate your account','Check your inbox',{
					closeButton: true,
					timeOut: 2000
				});
                loginService.logout();
            } else {
                $rootScope.loggedIn=true;
                if ($rootScope.user.avatar==''){
                    $rootScope.user.avatar='https://api.adorable.io/avatars/250/'+$rootScope.user.email;
                }
            }
        }
    });
});
