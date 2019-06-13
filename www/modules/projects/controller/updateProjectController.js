/**
  * @ngdoc controller
  * @name hellscripts.controller:updateProjectCtrl
  *
  * @description
  * The controller of the page to update any project
*/
hellscripts.controller('updateProjectCtrl', function ($scope, services, project,$cookies,$window,toastr,$route) {
    if (project.length==0 && typeof $cookies.get('idUser')==='undefined'){
        $window.location.href = '#/users';
		$window.location.reload();
    } else {
        $scope.update = project[0];
        $scope.update.price = parseInt(project[0].price);

        /**
         * Updates the project info using the new form info
         */
        $scope.updateProject = function(){
            find={};
            find.id=$route.current.params.id;
            project=$scope.update;
            update = {};
            update.name=$scope.update.name;
            update.description=$scope.update.description;
            update.website=$scope.update.website;
            update.image=$scope.update.image;
            update.price=$scope.update.price;
            update.license=$scope.update.license;
            update.languages=$scope.update.languages;
            services.put('projects',find,update).then(function(response){
                console.log(response);
                toastr.success('Project '+update.name, 'Updated!',{
                    closeButton: true
                });
            });
        }
    }
});