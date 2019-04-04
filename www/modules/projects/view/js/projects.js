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
            var params='';
            if (data.idAuthorization==1){
                params='/idUser-'+data.id;
                $("#resetApp").hide();
            }
            $.ajax({
                url: "api/projects"+params,  //LOAD PROJECTS
                type: 'GET',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                },
                success: function (data) {
                    data=JSON.parse(data);
                    data.forEach(element => {
                        $.ajax({
                            url: "www/modules/projects/view/projectTBody.php", //SHOW PROJECTS
                            type: 'POST',
                            async: false,
                            data: { data: element},
                            success: function(data) {
                                $('#allTableProjectsBody').append(data);
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                    });
                    $(".projectGet,  .projectDelete").click(function(){  //GET OR DELETE PROJECTS
                        var parent=$(this).parent().parent();
                        var projectId=parent.attr('id').replace('project','');
                        var method=$(this).attr('name');
                        object = {id: projectId}
                        $.ajax({
                            url: "api/projects/id-"+projectId,
                            type: method,
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                            },
                            success: function (data){
                                data=JSON.parse(data)[0];
                                console.log(data);
                                if (method=='GET'){
                                    $.each(data, function(key,value){
                                        $('#'+key+'ProjectModal').html(value);
                                    });
                                    $("#details_project").show();
                                    $("#project_modal").dialog({
                                        width: 850,
                                        height: 500,
                                        resizable: "false",
                                        modal: "true",
                                        buttons: {
                                            Ok: function () {
                                                $(this).dialog("close");
                                            }
                                        },
                                        show: {
                                            effect: "blind",
                                            duration: 1000
                                        },
                                        hide: {
                                            effect: "explode",
                                            duration: 1000
                                        }
                                    });
                                } else if(method=='DELETE'){
                                    parent.remove();
                                }
                            },
                            error: function (data){
                                console.log(data);
                            }
                        });
                    })
                },
                error: function (data) {
                    console.log(data);
                }
            });
            $("#createProject").click(function(){  //SHOW PROJECT FORM
                $('#projectPageContent').empty();
                $.ajax({
                    url: "www/modules/projects/controllers/create.php",
                    type: 'GET',
                    async: false,
                    success: function (data) {
                        $("#projectPageContent").append(data);
                        loadDatePicker();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
                $("#projectFormButton").click(function(){  //POST PROJECT
                    $('.projectError').empty();
                    var object = {};
                    var emptyValue = false;
                    var errorsList = [];
                    $('.projectFormElement').map(function(){
                        var name = $(this).attr('name');
                        var value = $(this).val();
                        if (value==""){
                            emptyValue=true;
                            errorsList.push(name);
                        }
                        object = Object.assign({[name]: value},object);
                    });
                    object = Object.assign({idUser: Cookies.get('idUser')},object);
                    if (!emptyValue){
                        $.ajax({
                            url: 'api/projects',
                            type: 'POST',
                            data: {data: JSON.stringify(object)},
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                            },
                            success: function(data){
                                console.log(data);
                                window.location.href = 'projects';
                            },
                            error: function(data){
                                console.log(data);
                                $('.projectError').html('<h4 class="errorText text-default" >Something went wrong...</h4>');
                                $('html, body').animate({
                                    scrollTop: $('html').offset().top
                                }, 500, 'easeInOutExpo');
                            }
                        });
                    } else {
                        $('.projectError').html('<h4 class="errorText text-default" >Please check the </h4>');
                        errorsList.forEach(function(value,index){
                            if (index === errorsList.length - 2){
                                $('.errorText').append(value+' and ');
                            } else if (index === errorsList.length - 1){
                                $('.errorText').append(value+'.');
                            } else {
                                $('.errorText').append(value+', ');
                            }
                        });
                        $('html, body').animate({
                            scrollTop: $('html').offset().top
                        }, 500, 'easeInOutExpo');
                    }
                });			  
            });   
            $("#deleteAllProjects").click(function(){  //SHOW PROJECT FORM
                $.ajax({
                    url: "api/projects",
                    type: 'DELETE',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                    },
                    success: function (data){
                        data=JSON.parse(data)[0];
                        $('#allTableProjectsBody').empty();
                    },
                    error: function (data){
        
                    }
                });
            });
        },
        error: function (data){
            console.log(data);
            window.location.href='users';
        }
    });
});
