/**
  * @ngdoc controller
  * @name hellscripts.controller:passwordCtrl
  *
  * @description
  * Manages the change password page
*/
hellscripts.controller('passwordCtrl', function($scope,services,$timeout,$rootScope,$cookies,$window,$route,toastr) {
    /**
     * Changes the password of the user using the params on the url and the new password entered on the form
     */
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