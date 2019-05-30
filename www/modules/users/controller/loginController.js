hellscripts.controller('loginCtrl', function($scope,services,$timeout,$rootScope,$cookies,$window,loginService) {

	$scope.submitLogin = function(){
		loginService.logout();
		var object = {};
		for (name in $scope.login){
			object = Object.assign({[name]: $scope.login[name]},object);
		}
		services.post('users',object).then(function (response) {
			$cookies.put('token',response);
			$cookies.put('email', object.email);
			services.get('users',{email: object.email}).then(function (response) {
				Cookies.set('idUser',response[0].id);
				$window.location.href = '#/';
				$window.location.reload();
			});
		});
	};

	$scope.submitRegister = function(){
		loginService.logout();
		var object = {};
		for (name in $scope.register){
			if (name!='repeatPassword'){
				object = Object.assign({[name]: $scope.register[name]},object);
			}
		}
		
		var token='';
		for (n=0;n<5;n++){
			newToken = Math.random().toString(36).substring(2, 15);
			token = token.concat(newToken);
		}
		$cookies.put('token',token);
		services.post('users',object).then(function (response) {
			$cookies.put('token',response);
			$cookies.put('email', object.email);
			services.get('users',{email: object.email}).then(function (response) {
				Cookies.set('idUser',response[0].id);
				$window.location.href = '#/';
				$window.location.reload();
			});
		});
	}

	$scope.recoverPassword = function(){
		var object = {};
		object.email=$scope.login.email;
		services.post('password',object).then(function (response) {
			$window.location.href = '#/';
			$window.location.reload();
		});
	}
});