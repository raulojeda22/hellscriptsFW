/**
  * @ngdoc controller
  * @name hellscripts.controller:loginCtrl
  *
  * @description
  * Manages the user actions
*/
hellscripts.controller('loginCtrl', function($scope,services,$timeout,$rootScope,$cookies,$window,loginService,toastr) {

	/**
	 * Submits a login request, logs a user in if it's successfull
	 */
	$scope.submitLogin = function(){
		loginService.logout();
		var object = {};
		for (name in $scope.login){
			object = Object.assign({[name]: $scope.login[name]},object);
		}
		services.post('users',object).then(function (response) {
			toastr.success('Logged in', '',{
				closeButton: true,
				timeOut: 1500
			});
			$cookies.put('token',response);
			$cookies.put('email', object.email);
			services.get('users',{email: object.email}).then(function (response) {
				Cookies.set('idUser',response[0].id);
				$window.location.href = '#/';
				$window.location.reload();
			});
		}, function(reason) {
			toastr.error('Wrong password', '',{
				closeButton: true,
				timeOut: 1500
			});
		});
	};

	/**
	 * Adds a user to the page and sends him an activation email
	 */
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
				toastr.success('Activation mail sent','',{
					closeButton: true,
					timeOut: 2000
				});
				Cookies.set('idUser',response[0].id);
				$window.location.href = '#/';
				$window.location.reload();
			},function(reason){
				console.log(reason);
				toastr.error('Something whent wrong','Probably the email already exists',{
					closeButton: true,
					timeOut: 2000
				});
			});
		});
	}

	/**
	 * Sends the recover password email to the mail entered on the login form
	 */
	$scope.recoverPassword = function(){
		var object = {};
		object.email=$scope.login.email;
		toastr.success('Email sent', '',{
			closeButton: true
		});
		services.post('password',object).then(function (response) {
			$window.location.href = '#/';
			$window.location.reload();
		});
	}
});