hellscripts.controller('contactCtrl', function ($scope, services,toastr) {
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
        toastr.success('Email sent', '',{
            closeButton: true
        });
        services.post('contact', object).then(function (response) {
            window.location.href = '';
        });
    };
});
