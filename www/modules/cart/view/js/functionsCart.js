$(document).ready(function(){
    token = Cookies.get('token');
    idUser = Cookies.get('idUser');
    if (token == null){
        $('.cartPost').click(function(){
            window.location.href = 'users';
        });
    } else {
        function checkPrices(){
            totalPrice=0;
            $('.projectPrice').each(function (){
                totalPrice=parseInt($(this).text())+parseInt(totalPrice);
            })
            $('#totalPrice').html('Total '+totalPrice+'€');
        }
        checkPrices();
        $('.cartPost').click(function(){
            idProject=$(this).attr('data-id');
            var object= {};
            object = Object.assign({idUser: idUser},object);
            object = Object.assign({idProject: idProject},object);
            $.ajax({
                url: 'www/modules/cart/model/cart.php',
                type: 'POST',
                data: { data: JSON.stringify(object)},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function (data){
                    $.ajax({
                        url: 'www/modules/cart/model/cart.php?idUser='+idUser+'&idProject='+idProject,
                        type: 'GET',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", token);
                        },
                        success: function (data){
                            data=JSON.parse(data);
                            productArray[idProject].push(data[data.length-1].id);
                            $('#totalPrice'+idProject).html(($('#price'+idProject).text()*productArray[idProject].length));
                            $("#count"+idProject).html(parseInt($("#count"+idProject).text())+1);
                            checkPrices();
                        },
                        error: function (data){
                            console.log(data);
                        }
                    });
                },
                error: function (data){
                    console.log(data);
                }
            });
        });
        $('.cartDelete').click(function(){
            idProject=$(this).attr('data-id');
            if (productArray[idProject][0] != undefined){
                $.ajax({
                    url: 'www/modules/cart/model/cart.php?idUser='+idUser+'&id='+productArray[idProject][0],
                    type: 'DELETE',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", token);
                    },
                    success: function (data){
                        productArray[idProject].splice(0, 1);
                        $('#totalPrice'+idProject).html(($('#price'+idProject).text()*productArray[idProject].length));
                        $("#count"+idProject).html(parseInt($("#count"+idProject).text())-1);
                        checkPrices();
                    },
                    error: function (data){
                        console.log(data);
                    }
                });
            }
        });
        $('.projectDelete').click(function(){
            idProject=$(this).attr('data-id');
            $.ajax({
                url: 'www/modules/cart/model/cart.php?idUser='+idUser+'&idProject='+idProject,
                type: 'DELETE',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function (data){
                    productArray.splice(idProject, 1);
                    $('#project'+idProject).remove();
                    checkPrices();
                },
                error: function (data){
                    console.log(data);
                }
            });
        });
        $('#checkoutCart').click(function(){
            $.ajax({
                url: 'www/modules/cart/model/cartCheckout.php',
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function (data){
                    console.log(data);
                    window.location.href='home';
                },
                error: function (data){
                    console.log('miau');
                    console.log(data);
                }
            });
        });
    }
});