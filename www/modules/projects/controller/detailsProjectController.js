/**
  * @ngdoc controller
  * @name hellscripts.controller:detailsProjectCtrl
  *
  * @description
  * Loads the project details on the scope
*/
hellscripts.controller('detailsProjectCtrl', function ($scope, services, project) {
    $scope.project = project[0];
});