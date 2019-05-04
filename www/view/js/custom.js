jQuery(document).ready(function() {
	var token = Cookies.get('token');
	var email = Cookies.get('email');
	var idUser = Cookies.get('idUser');
	
	if (token!=''){
		/* Esto no deuria estar comentat
		$.ajax({
			url: "/hellscriptsFW/api/users/id-"+idUser,
			type: 'GET',
			beforeSend: function (xhr) {
				xhr.setRequestHeader ("Authorization", token);
			},
			success: function (data) {
				data = JSON.parse(data)[0];
				$('#userButton').html('<button class="btn btn-primary btn-sm btn-link logout">Log out <i class="icon-user"></i></button>')
				$('#userInfo').html('<h4>'+data.email+' <img src="https://api.adorable.io/avatars/40/'+data.email+'"/></h4>')
				$('#cartLink').attr("href", 'cart');
				$('.logout').click(function (){
					Cookies.remove('email');
					Cookies.remove('token');
					Cookies.remove('idUser');
					window.location.href='home';
				});
			},
			error: function (data){
				console.log(data);
			}
		});
		*/
	}
});