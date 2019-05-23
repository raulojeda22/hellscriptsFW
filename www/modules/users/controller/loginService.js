hellscripts.factory("loginService", ['services','$cookies','$window',
function (services,$cookies,$window) {
    var service = {};
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