$(document).ready(function() {
    var token=Cookies.get('token');
    var email=Cookies.get('email');
    var idUser=Cookies.get('idUser');
    $.ajax({
        url: "www/modules/users/model/users.php?id="+idUser,  //LOAD PROJECTS
        type: 'GET',
        beforeSend: function (xhr) {
			xhr.setRequestHeader ("Authorization", Cookies.get('token'));
		},
        success: function (data) {
            data=JSON.parse(data)[0];
            $('.userProfile').html(data.username);
            $('.emailProfile').html(data.email);
            $('.nameProfile').html(data.name);
            $('.imageProfile').attr('src','https://api.adorable.io/avatars/500/'+data.email);
            $.ajax({
                url: "www/modules/projects/model/projects.php?idUser="+data.id,  //LOAD PROJECTS
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
