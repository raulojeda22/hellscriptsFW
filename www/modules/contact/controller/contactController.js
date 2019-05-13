hellscripts.controller('contactCtrl', function ($scope, services) {
    $scope.contact = {
        name: "",
        surname: "",
        email: "",
        message: ""
    };

    $scope.SubmitContact = function () {
        var object = {};
        Object.keys($scope.contact).forEach(function(key) {
            object = Object.assign({[key]: $scope.contact[key]},object);
        });
        services.post('contact', object).then(function (response) {
            window.location.href = '';
        });
    };
});
