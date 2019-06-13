/**
  * @ngdoc service
  * @name hellscripts.loginService
  * 
  * @description
  * Used to make login actions that can be done from anywhere on the page
**/
hellscripts.factory("loginService", ['services','$cookies','$window','toastr',
function (services,$cookies,$window,toastr) {
    var service = {};
    /**
     * Removes the cookies related to the authentication credentials
     */
    service.logout = function () {
        $cookies.remove('token');
        $cookies.remove('idUser');
        $cookies.remove('email');

        $cookies.remove('token',{path:'/'});
        $cookies.remove('idUser',{path:'/'});
        $cookies.remove('email',{path:'/'});

        $cookies.remove('token',{path:'/hellscriptsFW/'});
        $cookies.remove('idUser',{path:'/hellscriptsFW/'});
        $cookies.remove('email',{path:'/hellscriptsFW/'});
    }
    return service;
}]);