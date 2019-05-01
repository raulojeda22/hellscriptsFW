window.addEventListener('load', function() {
    var idToken;
    var accessToken;
    var expiresAt;
  
    var webAuth = new auth0.WebAuth({
      domain: 'raulojeda.eu.auth0.com',
      clientID: '0qDeBksiQ6DMDWfISnE5cyvuTp4Ftynz',
      responseType: 'token id_token',
      scope: 'openid profile email offline_access',
      redirectUri: window.location.href
    });
  
    var loginBtn = document.getElementById('socialLogin');
  
    loginBtn.addEventListener('click', function(e) {
      e.preventDefault();
      Cookies.set('socialMediaAction','login');      
      webAuth.authorize();
    });

    var registerBtn = document.getElementById('socialRegister');
  
    registerBtn.addEventListener('click', function(e) {
      e.preventDefault();
      Cookies.set('socialMediaAction','register');
      webAuth.authorize();
    });

    webAuth.parseHash(function(err, authResult) {
        console.log(authResult);
        if (authResult && authResult.accessToken && authResult.idToken){
            webAuth.client.userInfo(authResult.accessToken, function(err, profile) {
                console.log(profile);
                object = {};
                object.name=profile.name;
                object.username=profile.nickname;
                object.avatar=profile.picture;
                email=profile.email+profile.sub;
                object.email=email.substr(0, email.indexOf('-'));
                object.password=authResult.idToken;
                socialMediaAction=Cookies.get('socialMediaAction');
                if (socialMediaAction=='register'){
                    $.ajax({ //REGISTER
                        url: 'api/users',
                        type: 'POST',
                        data: {data: JSON.stringify(object)},
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader ("Authorization", authResult.refreshToken);
                        },
                        success: function(data){
                            Cookies.set('token', authResult.refreshToken);
                            Cookies.set('email', object.email);
                            $.ajax({
                                url: "api/users/email-"+object.email,
                                type: 'GET',
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader ("Authorization", authResult.refreshToken);
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
                    $.ajax({ //LOGIN
                        url: 'api/users',
                        type: 'POST',
                        data: {data: JSON.stringify(object)},
                        success: function(data){
                            console.log(data);
                            Cookies.set('token', data);
                            Cookies.set('email', object.email);
                            $.ajax({
                                url: "api/users/email-"+object.email,
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
                }
            });
        }
    });
});