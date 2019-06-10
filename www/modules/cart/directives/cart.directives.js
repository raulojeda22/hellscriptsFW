hellscripts.directive('cartButton',function (services,$cookies,toastr) {
    return{
        restrict: 'E',
        template: '<button ng-show="loggedIn" class="btn btn-primary btn-sm cartPost" data-id="{{project.id}}" name="POST"><i class="icon-cart"></i></button>',
        link: function(scope, element, attrs) {
            element.bind('click', function(){
                idProject=scope.project.id;
                idUser=$cookies.get('idUser');
                project = {};
                project.idUser=idUser;
                project.idProject=idProject;
                services.post('cart',project).then(function(response){
                    if (response){
                        toastr.success('Added to cart', '',{
                            closeButton: true
                        });
                    }
                })
            });
        }
    }
});