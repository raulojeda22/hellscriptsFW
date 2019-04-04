$(document).ready(function() {
    $.ajax({
        url: "www/modules/explore/model/getSearchParams.php",
        type: "GET",
        success: function(data){
            data=JSON.parse(data);
            $.ajax({
                url: "api/projects/license-"+data.license+"/languages-"+data.languages+"/name-"+data.name,
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
                                $('#exploreProjects').append(data);
                                $(".projectGet").click(function(){  //GET PROJECTS
                                    var parent=$(this).parent();
                                    var projectId=parent.attr('id').replace('project','');
                                    var method=$(this).attr('name');
                                    object = {id: projectId}
                                    $.ajax({
                                        url: "api/projects/id-"+projectId,
                                        type: method,
                                        async: false,
                                        beforeSend: function (xhr) {
                                            xhr.setRequestHeader ("Authorization", Cookies.get('token'));
                                        },
                                        success: function (data){
                                            data=JSON.parse(data)[0];
                                            $('html, body').animate({
                                                scrollTop: $('html').offset().top
                                            }, 500, 'easeInOutExpo');
                                            $.ajax({
                                                url: "www/modules/projects/view/projectPage.php",
                                                type: 'POST',
                                                async: false,
                                                data: { data: data},
                                                success: function (data){
                                                    $('#explorePageContent').html(data);
                                                }
                                            });
                                        },
                                        error: function (data){
                                            console.log(data);
                                        }
                                    });
                                })
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                    });
                    $('#exploreProjects').append('<script src="www/modules/cart/view/js/functionsCart.js"></script>');
                },
                error: function(data){
                    console.log(data);
                }
            });
            ;
            repositoryName=data.name.substr(1).slice(0, -1);
            $.ajax({
                url: 'https://api.github.com/search/repositories?q='+repositoryName+'&sort=stars&order=desc',
                type: 'GET',
                success: function(data){
                    console.log(data);
                    data.items.forEach(function(element){
                        var object = {};
                        object = Object.assign({image: element.owner.avatar_url},object);
                        object = Object.assign({id: element.id},object);
                        object = Object.assign({name: element.full_name},object);
                        object = Object.assign({languages: element.language},object);
                        object = Object.assign({url: element.svn_url},object);
                        $.ajax({
                            url: "www/modules/projects/view/projectGithubDiv.php", //SHOW PROJECTS
                            type: 'POST',
                            async: false,
                            data: { data: object},
                            success: function(data) {
                                $('#githubExploreProjects').append(data);
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                    });
                    $(".githubGet").click(function(){  //GET PROJECTS
                        var parent=$(this).parent();
                        var projectId=parent.attr('name');
                        var method=$(this).attr('name');
                        object = {id: projectId}
                        $.ajax({
                            url: "https://api.github.com/repos/"+projectId,
                            type: method,
                            success: function (data){
                                console.log(data);
                                var object = {};
                                object = Object.assign({image: data.owner.avatar_url},object);
                                object = Object.assign({description: data.description},object);
                                object = Object.assign({name: data.full_name},object);
                                object = Object.assign({languages: data.language},object);
                                object = Object.assign({website: data.svn_url},object);
                                object = Object.assign({privacy: 'public'},object);
                                if (data.license != null){
                                    object = Object.assign({license: data.license.spdx_id},object);
                                } else {
                                    object = Object.assign({license: 'Not specified'},object);
                                }
                                $('html, body').animate({
                                    scrollTop: $('html').offset().top
                                }, 500, 'easeInOutExpo');
                                $.ajax({
                                    url: "www/modules/projects/view/projectGithubPage.php",
                                    type: 'POST',
                                    data: { data: object},
                                    success: function (data){
                                        $('#explorePageContent').html(data);
                                    }
                                });
                            },
                            error: function (data){
                                console.log(data);
                            }
                        });
                    })
                },
                error: function (data){
                    console.log(data);
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });
    
});
