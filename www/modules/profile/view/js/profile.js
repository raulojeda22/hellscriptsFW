$(document).ready(function() {
    var token=Cookies.get('token');
    var email=Cookies.get('email');
    var idUser=Cookies.get('idUser');  
    $.ajax({
        url: "api/users/id-"+idUser,  //LOAD PROJECTS
        type: 'GET',
        beforeSend: function (xhr) {
			xhr.setRequestHeader ("Authorization", Cookies.get('token'));
		},
        success: function (data) {
            data=JSON.parse(data)[0];
            $.ajax({
                url: "www/modules/profile/view/updateProfile.php",  //LOAD PROJECTS
                type: 'POST',
                success: function (profile) {
                    $('#profileOptions').html(profile);
                    for (key in data){
                        $('#'+key+"Update").val(data[key]);
                    }
                    $('#updateSubmit').click(function(){
                        $('.updateError').empty();
                        var object = {};
                        var emptyValue = false;
                        var errorsList = [];
                        $('.updateFormElement').map(function(){
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
                            console.log(object);
                            $.ajax({
                                url: "api/users",  
                                type: 'PUT',
                                data: { data: [{id: idUser}, JSON.stringify(object)]},
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                                },
                                success: function (data) {
                                    console.log(data);
                                }, error: function (data){
                                    console.log(data);
                                }
                            });
                            /*            
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
                                    $('.updateError').html('<h4 class="errorText text-default" >Wrong input</h4>');
                                    $('html, body').animate({
                                        scrollTop: $('html').offset().top
                                    }, 500, 'easeInOutExpo');
                                }
                            });
                            */
                        } else {
                            $('.updateError').html('<h4 class="updateErrorText text-default" >Please check the </h4>');
                            errorsList.forEach(function(value,index){
                                if (index === errorsList.length - 2){
                                    $('.updateErrorText').append(value+' and ');
                                } else if (index === errorsList.length - 1){
                                    $('.updateErrorText').append(value+'.');
                                } else {
                                    $('.updateErrorText').append(value+', ');
                                }
                            });
                            $('html, body').animate({
                                scrollTop: $('html').offset().top
                            }, 500, 'easeInOutExpo');
                        }
                    });
                }
            });
            $('.userProfile').html(data.username);
            $('.emailProfile').html(data.email);
            $('.nameProfile').html(data.name);
            $('.imageProfile').attr('src','https://api.adorable.io/avatars/500/'+data.email);
            $.ajax({
                url: "api/projects/idUser-"+data.id,  //LOAD PROJECTS
                type: 'GET',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                },
                success: function (data) {
                    data=JSON.parse(data);
                    data.forEach(element => {
                        $.ajax({
                            url: "www/modules/projects/view/projectDiv.php", //SHOW PROJECTS
                            type: 'POST',
                            async: false,
                            data: { data: element},
                            success: function(data) {
                                $('#allProfileProjects').append(data);
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                    });
                }, error: function(data) {
                    console.log(data);
                }
            })
        },
        error: function (data){
            console.log(data);
            window.location.href='users';
        }
    });
});
