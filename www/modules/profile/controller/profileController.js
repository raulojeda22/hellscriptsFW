hellscripts.controller('profileCtrl', function($scope,services,$cookies,$window,loginService,toastr,$rootScope) {
	$scope.updateMenu=false;
	$scope.userMenu=true;
	$scope.projectsMenu=false;
	$scope.updateData = {};
	$scope.updateData.username = $rootScope.user.username;
	$scope.updateData.name = $rootScope.user.name;
	$scope.updateData.email = $rootScope.user.email;
	$scope.updateProfile = function(){
		$scope.updateMenu=true;
		$scope.userMenu=false;
		$scope.projectsMenu=false;
	}
	$scope.userProfile = function(){
		$scope.updateMenu=false;
		$scope.userMenu=true;
		$scope.projectsMenu=false;
	}
	$scope.projectsProfile = function(){
		$scope.updateMenu=false;
		$scope.userMenu=false;
		$scope.projectsMenu=true;
	}
	$scope.update = function(){
		var find = {};
		find.id=$rootScope.user.id;
		console.log($rootScope.user.id);
        var updateData = {};
		updateData.username=$scope.updateData.username;
        updateData.name=$scope.updateData.name;
        updateData.email=$scope.updateData.email;
        toastr.success('User updated', '',{
            closeButton: true
        });
        services.put('users',find,updateData).then(function (response) {
            $window.location.href = '#/';
            $window.location.reload();
        });
	}

});
