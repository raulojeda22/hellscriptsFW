hellscripts.controller('profileCtrl', function($scope,services,$cookies,$window,loginService,toastr,$rootScope) {
	$scope.updateMenu=false;
	$scope.userMenu=true;
	$scope.projectsMenu=false;
	$scope.updateData = {};
	setTimeout(function(){
		$scope.updateData.username = $rootScope.user.username;
		$scope.updateData.name = $rootScope.user.name;
		$scope.updateData.email = $rootScope.user.email;
		$scope.updateData.avatar = $rootScope.user.avatar;
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
			services.get('projects',{idUser:$rootScope.user.id}).then(function(data){
				$scope.myProjects=data;
			});
		}
		$scope.update = function(){
			var find = {};
			find.id=$rootScope.user.id;
			var updateData = {};
			updateData.username=$scope.updateData.username;
			updateData.name=$scope.updateData.name;
			updateData.email=$scope.updateData.email;
			updateData.avatar=$scope.updateData.avatar;
			updateData.country=$scope.selectedCountry;
			updateData.province=$scope.selectedProvince;
			toastr.success('User updated', '',{
				closeButton: true
			});
			services.put('users',find,updateData).then(function (response) {
				$window.location.href = '#/';
				$window.location.reload();
			});
		}
	},500);

	$scope.dropzoneConfig = {
		'options': {
			'url': 'www/modules/profile/model/uploadImage.php',
			addRemoveLinks: false,
			maxFileSize: 1000,
			dictResponseError: "Ha ocurrido un error en el server",
			acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd'
		},
		'eventHandlers': {
			'sending': function (file, formData, xhr) {},
			'success': function (file, response) {
				response = JSON.parse(response);
				console.log(response);
				$scope.updateData.avatar=response.data;
				if (response.result) {
					$(".msg").addClass('msg_ok').removeClass('msg_error').text('Success Upload image!!');
					$('.msg').animate({'right': '300px'}, 300);
				} else {
					$(".msg").addClass('msg_error').removeClass('msg_ok').text(response['error']);
					$('.msg').animate({'right': '300px'}, 300);
				}
			}
		}
	};

	services.getFile('www/view/json/countries.json').then(function(data){
		$scope.countries = data;
	});

});
