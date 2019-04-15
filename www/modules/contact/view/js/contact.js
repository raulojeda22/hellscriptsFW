$(document).ready(function(){
    $('#submit').click(function(){
        $('.contactError').empty();
        var object = {};
        var emptyValue = false;
        var errorsList = [];
        $('.contactFormElement').map(function(){
            var name = $(this).attr('name');
            var value = $(this).val();
            if (value==""){
                emptyValue=true;
                errorsList.push(name);
            }
            object = Object.assign({[name]: value},object);
        });
        if (!emptyValue){
            $.ajax({
                url: 'api/contact',
                type: 'POST',
                data: {data: JSON.stringify(object)},
                success: function(data){
                    console.log(data);
                    window.location.href = 'home';
                },
                error: function(data){
                    console.log(data);
                    $('.contactError').html('<h4 class="errorText text-default" >Something went wrong...</h4>');
                    $('html, body').animate({
                        scrollTop: $('html').offset().top
                    }, 500, 'easeInOutExpo');
                }
            });
        } else {
            $('.contactError').html('<h4 class="errorText text-default" >Please check the </h4>');
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
    })
});