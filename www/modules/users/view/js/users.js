$(document).ready(function(){
    function login(){
        $('.loginError').empty();
        var object = {};
        var emptyValue = false;
        var errorsList = [];
        var email='';
        $('.loginFormElement').map(function(){
            var name = $(this).attr('name');
            var value = $(this).val();
            if (value==""){
                emptyValue=true;
                errorsList.push(name);
            }
            if (name=='email'){
                email=value;
            }
            object = Object.assign({[name]: value},object);
        });
        if (!emptyValue){
            $.ajax({
                url: 'api/users',
                type: 'POST',
                data: {data: JSON.stringify(object)},
                success: function(data){
                    Cookies.set('token', data);
                    Cookies.set('email', email);
                    $.ajax({
                        url: "api/users/email-"+email,
                        type: 'GET',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", data);
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            Cookies.set('idUser',data[0].id);
                            window.location.href = 'home'
                        },
                        error: function (data){
                            console.log(data);
                        }
                    });
                },
                error: function(data){
                    console.log(data)
                    $('.loginError').html('<h4 class="errorText text-default" >Wrong email or password</h4>');
                    $('html, body').animate({
                        scrollTop: $('html').offset().top
                    }, 500, 'easeInOutExpo');
                }
            });
            
        } else {
            $('.loginError').html('<h4 class="loginErrorText text-default" >Please check the </h4>');
            errorsList.forEach(function(value,index){
                if (index === errorsList.length - 2){
                    $('.loginErrorText').append(value+' and ');
                } else if (index === errorsList.length - 1){
                    $('.loginErrorText').append(value+'.');
                } else {
                    $('.loginErrorText').append(value+', ');
                }
            });
            $('html, body').animate({
                scrollTop: $('html').offset().top
            }, 500, 'easeInOutExpo');
        }
    }
    function register(){
        $('.registerError').empty();
        var object = {};
        var emptyValue = false;
        var errorsList = [];
        $('.registerFormElement').map(function(){
            var name = $(this).attr('name');
            var value = $(this).val();
            if (value==""){
                emptyValue=true;
                errorsList.push(name);
            }
            if (name=='email'){
                email=value;
            }
            if (name!='repeatPassword'){
                object = Object.assign({[name]: value},object);
            }
        });
        if ($('#passwordRegister').val() != $('#repeatPasswordRegister').val()){
            emptyValue=true;
            errorsList.push('passwords are different')
        };
        if (!emptyValue){            
            var token='';
            for (n=0;n<5;n++){
                newToken = Math.random().toString(36).substring(2, 15);
                token = token.concat(newToken);
            }
            $.ajax({
                url: 'api/users',
                type: 'POST',
                data: {data: JSON.stringify(object)},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                },
                success: function(data){
                    Cookies.set('token', data);
                    Cookies.set('email', email);
                    $.ajax({
                        url: "api/users/email-"+email,
                        type: 'GET',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", token);
                        },
                        success: function (data) {
                            data = JSON.parse(data);
                            Cookies.set('idUser',data[0].id);
                            window.location.href = 'home'
                        },
                        error: function (data){
                            console.log(data);
                        }
                    });
                },
                error: function(data){
                    console.log(data)
                    $('.registerError').html('<h4 class="errorText text-default" >Wrong input</h4>');
                    $('html, body').animate({
                        scrollTop: $('html').offset().top
                    }, 500, 'easeInOutExpo');
                }
            });
        } else {
            $('.registerError').html('<h4 class="registerErrorText text-default" >Please check the </h4>');
            errorsList.forEach(function(value,index){
                if (index === errorsList.length - 2){
                    $('.registerErrorText').append(value+' and ');
                } else if (index === errorsList.length - 1){
                    $('.registerErrorText').append(value+'.');
                } else {
                    $('.registerErrorText').append(value+', ');
                }
            });
            $('html, body').animate({
                scrollTop: $('html').offset().top
            }, 500, 'easeInOutExpo');
        } 
    }
    $(document).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var loginCount = 0;
        var registerCount = 0;
        if(keycode == '13'){
            $('.loginFormElement').map(function(){
                if ($(this).is(":focus")){
                    loginCount++;
                }
            });
            $('.registerFormElement').map(function(){
                if ($(this).is(":focus")){
                    registerCount++;
                }
            });
            if(loginCount!=0){
                login();
            } else if (registerCount!=0){
                register();
            }
        }
    });
    $('#loginSubmit').click(function(){
        login();
    });
    $('#registerSubmit').click(function(){
        register();
    });
});