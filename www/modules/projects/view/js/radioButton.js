$('#checkBoxValue').val('public');
$('.toggle_option').bind('change', function(){
    $('#checkBoxValue').val($(this).val());
})