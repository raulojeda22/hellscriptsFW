$(document).ready(function(){
    var language='english';
    function translatePage(){
        if (language!='english'){
            $.ajax({
                url: 'www/view/languages/'+language+'.json',
                type: 'GET',
                contentType: 'json',
                success: function(data){
                    var languageData = data;
                    $('.translate').each(function(){
                        if (typeof languageData[$(this).text().trim()] === 'undefined'){
                            $(this).text(languageData[$(this).attr('data-original').trim()]);                    
                        } else {
                            $(this).text(languageData[$(this).text().trim()]);                    
                        }
                    });
                },
                error: function(data){
                    console.log('ERROR');
                    console.log(data);
                }
            });
        } else {
            $('.translate').each(function(){
                $(this).text($(this).attr('data-original').trim());
            });
        }
        $('#languageDropdown').attr('src',$('#'+language+'Language').children('img').attr('src'));
    }

    $('.changeLanguage').click(function (){
        language=$(this).attr('name');
        translatePage();   
    });
});
