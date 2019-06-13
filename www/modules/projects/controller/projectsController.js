/**
  * @ngdoc controller
  * @name hellscripts.controller:projectsCtrl
  *
  * @description
  * Manages the projects CRUD
*/
hellscripts.controller('projectsCtrl', function ($scope, services, projects,$cookies,$window,toastr) {
    if (projects.length==0 && typeof $cookies.get('idUser')==='undefined'){
        $window.location.href = '#/users';
		$window.location.reload();
    } else {
        $scope.crudProjectsPage = true;
        $scope.projects=projects;

        /**
         * Deletes a project by it's id
         * 
         * @param {int} id project db id
         */
        $scope.deleteProject = function(id){
            document.getElementById('project'+id).style.display = 'none';
            services.delete('projects',{id: id}).then(function(data){
                if (data){
                    toastr.success('Project '+id, 'Removed',{
                        closeButton: true
                    });
                }
            });
        }
        /**
         * Shows the create project page
         */
        $scope.createPage = function(){
            $scope.createProjectPage = true;
            $scope.crudProjectsPage = false;
        }

        /**
         * Shows the crud page
         */
        $scope.crudPage = function(){
            $scope.createProjectPage = false;
            $scope.crudProjectsPage = true;
        }

        /**
         * Creates a project using the data on the create form
         */
        $scope.createProject = function(){
            postData=$scope.create;
            postData.idUser=$cookies.get('idUser');
            postData.privacy=$cookies.get('idUser');
            services.post('projects',postData).then(function(response){
                if (response){
                    toastr.success('Project '+postData.name, 'Added!',{
                        closeButton: true
                    });
                }
            },function(reason){
                console.log(reason);
            });
        }
    }
});