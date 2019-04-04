var productArray = [];;
$(document).ready(function(){
    var token=Cookies.get('token');
    var idUser=Cookies.get('idUser');
    $.ajax({
        url: "api/cart/idUser-"+idUser,  //LOAD PROJECTS
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", token);
        },
        success: function (data) {
            data=JSON.parse(data);
            data.forEach(element =>{
                if (productArray[element.idProject]==null){
                    productArray[element.idProject] = [];
                }
                productArray[element.idProject].push(element.id);
            });
            productArray.forEach(function (element,index) {
                $.ajax({
                    url: "api/projects/id-"+index,  //LOAD PROJECTS
                    type: 'GET',
                    async: false,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", token);
                    },
                    success: function (data) {
                        project = JSON.parse(data)[0];
                        $.ajax({
                            url: "www/modules/cart/view/cartTBody.php", //SHOW PROJECTS
                            type: 'POST',
                            async: false,
                            data: { data: project, count: element.length},
                            success: function(data) {
                                $('#allTableCartBody').append(data);
                                $('#totalPrice'+index).html((project.price*element.length));
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                    },
                    error: function (data){
                        console.log(data);
                    }
                });
            });
            $('#cartPageContent').append('<script src="www/modules/cart/view/js/functionsCart.js"></script>');
        }
    });
});