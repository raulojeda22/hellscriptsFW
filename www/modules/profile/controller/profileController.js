/**
  * @ngdoc controller
  * @name hellscripts.controller:profileCtrl
  *
  * @description
  * Manages the login page
*/
hellscripts.controller('profileCtrl', function($scope,services,$cookies,$window,loginService,toastr,$rootScope,user) {
	if (typeof user === 'undefined'){
		$window.location.href = '#/users';
		$window.location.reload();
	} else {
		/**
		 * hides the content of the page
		 */
		function hideData(){
			$scope.updateMenu=false;
			$scope.userMenu=false;
			$scope.projectsMenu=false;
			$scope.ordersMenu=false;
		}
		user=user[0];
		$scope.updateMenu=false;
		$scope.userMenu=true;
		$scope.projectsMenu=false;
		$scope.updateData = {};
		$scope.updateData.username = user.username;
		$scope.updateData.name = user.name;
		$scope.updateData.email = user.email;
		$scope.updateData.avatar = user.avatar;

		/**
		 * Loads the update profile page
		 */
		$scope.updateProfile = function(){
			hideData();
			$scope.updateMenu=true;
		}

		/**
		 * Loads the user profile page
		 */
		$scope.userProfile = function(){
			hideData();
			$scope.userMenu=true;
		}

		/**
		 * Loads the owned projects page
		 */
		$scope.projectsProfile = function(){
			hideData();
			$scope.projectsMenu=true;
			services.get('projects',{idUser:user.id}).then(function(data){
				$scope.myProjects=data;
			});
		}

		/**
		 * @returns {int} the total price of that order
		 */
		$scope.totalOrderPrice = function(button){
			return ($scope.ordersArray[button.order.id].length * button.order.price )+'€';
		}

		/**
		 * @returns {int} the total number of projects on that order
		 */
		$scope.totalOrders = function(button){
			return $scope.ordersArray[button.order.id].length;
		}	

		/**
		 * @returns {int} the total price of all the orders
		 */
		$scope.totalPrice = function(){
			var total = 0;
			$scope.orders.forEach(function (element,index) {
				total=total+(parseInt(element.price)*$scope.ordersArray[element.id].length);
			});
			return total+'€';
		};

		/**
		 * Loads the ordered projects page
		 */
		$scope.ordersProfile = function(){
			hideData();
			$scope.ordersMenu=true;
			services.get('checkout',{idUser:user.id}).then(function(orders){
				$scope.orders=[];
				$scope.ordersArray = [];
				orders.forEach(element =>{
					if ($scope.ordersArray[element.idProject]==null){
						$scope.ordersArray[element.idProject] = [];
					}
					$scope.ordersArray[element.idProject].push(element.id);
				});
				$scope.ordersArray.forEach(function (element,index) {
					services.get('projects',{id:index}).then(function(data){
						$scope.orders.push(data[0]);
					});
				});
			});
		}

		/**
		 * Updates the user profile
		 */
		$scope.update = function(){
			var find = {};
			find.id=user.id;
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
	}
});
