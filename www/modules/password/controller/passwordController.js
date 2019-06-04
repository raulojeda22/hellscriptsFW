hellscripts.controller('passwordCtrl', function($scope,services,$timeout,$rootScope,$cookies,$window,$route,toastr) {
    $scope.changePassword = function(){
        var find = {};
        find.token=$route.current.params.token;
        find.email=$route.current.params.email;
        var update = {};
        update.password=$scope.register.password;
        toastr.success('Password changed', '',{
            closeButton: true
        });
        services.put('users',find,update).then(function (response) {
            $window.location.href = '#/';
            $window.location.reload();
        });
    }
});