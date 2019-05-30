hellscripts.controller('passwordCtrl', function($scope,services,$timeout,$rootScope,$cookies,$window,$route) {
    $scope.changePassword = function(){
        var find = {};
        find.token=$route.current.params.token;
        find.email=$route.current.params.email;
        var update = {};
        console.log($scope.register.password);

        update.password=$scope.register.password;
        console.log(update);

        services.put('users',find,update).then(function (response) {
            console.log(response);
            $window.location.href = '#/';
            $window.location.reload();
        });
    }
});