hellscripts.controller('cartCtrl', function($scope,services,$cookies,$window,loginService,toastr,cart) {
    $scope.projects=[];
    $scope.productArray = [];
    cart.forEach(element =>{
        if ($scope.productArray[element.idProject]==null){
            $scope.productArray[element.idProject] = [];
        }
        $scope.productArray[element.idProject].push(element.id);
    });
    $scope.productArray.forEach(function (element,index) {
        services.get('projects',{id:index}).then(function(data){
            $scope.projects.push(data[0]);
        });
    });

    $scope.cartPost = function(button){
        idProject=button.project.id;
        idUser=$cookies.get('idUser');
        project = {};
        project.idUser=idUser;
        project.idProject=idProject;
        services.post('cart',project).then(function(response){
            services.get('cart',{idUser:idUser,idProject:idProject}).then(function(data){
                $scope.productArray[idProject].push(data[data.length-1].id);
            })
        })

    };

    $scope.cartDelete = function(button){
        idProject=button.project.id;
        if ($scope.productArray[idProject][0] != undefined){
            services.delete('cart',{idUser:$cookies.get('idUser'),id:$scope.productArray[idProject][0]}).then(function(response){
                if (response){
                    $scope.productArray[idProject].splice(0, 1);
                }
            })
        }
    };

    $scope.projectDelete = function(button){
        services.delete('cart',{idUser: $cookies.get('idUser'), idProject: button.project.id}).then(function(response){
            if (response){
                $scope.projects = $scope.projects.filter(function(value,index){
                    return value.id != button.project.id;
                });
                toastr.success('Project '+button.project.name, 'Removed!',{
                    closeButton: true
                });
            }
        });
    };

    $scope.totalProjectPrice = function(button){
        return $scope.productArray[button.project.id].length * button.project.price;
    }

    $scope.totalProjects = function(button){
        return $scope.productArray[button.project.id].length;
    }

    $scope.totalPrice = function(){
        var total = 0;
        $scope.projects.forEach(function (element,index) {
            total=total+(parseInt(element.price)*$scope.productArray[element.id].length);
        });
        return total+' €';
    };

    $scope.checkoutCart = function(){
        services.post('checkout',{}).then(function(response){
            if (response){
                $scope.productArray = [];
                $scope.projects = [];
                toastr.success('Successfully!', 'Checkout completed',{
                    closeButton: true
                });
            }
        })
    };
});