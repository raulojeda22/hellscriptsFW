hellscripts.controller('homeCtrl', function ($scope, services, projects) {
	$scope.originalProjects = projects;
  	$scope.projects = projects;
	$scope.currentPage = 1;
	$scope.filterProjects = $scope.projects.slice(0,12);

	$scope.pageChanged = function() {
	  var startPos = ($scope.currentPage - 1) * 12;
	  $scope.filterProjects = $scope.projects.slice(startPos, startPos + 12);
	};

	$scope.selectSearch = function(input){
		if (typeof input.projectSelected === 'object' && input.projectSelected !== null){
			window.location.href='#/explore/'+input.projectSelected.id;
		} else {
			selectedProjects=[];
			$scope.originalProjects.forEach(function(project){
				if(project.name.toLowerCase().indexOf(input.projectSelected) !== -1){
					selectedProjects.push(project);
				}
			});
			$scope.projects = selectedProjects;
			$scope.currentPage = 1;
			$scope.filterProjects = $scope.projects.slice(0,12);
		}
	}
});

hellscripts.controller('menuCtrl', function($scope,services,$cookies,$window,loginService,toastr) {
	$scope.logout = function(){
		toastr.success('Logged out','See you!',{
			closeButton: true,
			timeOut: 2000
		});	
		loginService.logout();
		services.delete('auth0',{}).then(function(response){
			$window.location.href = response;
		});
	}
});
