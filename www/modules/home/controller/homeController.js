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
		console.log(input.projectSelected);
		if (typeof input.projectSelected === 'object' && input.projectSelected !== null){
			console.log('perro');
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