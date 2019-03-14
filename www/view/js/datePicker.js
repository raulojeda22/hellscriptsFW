function loadDatePicker(){
    $('.datePicker').datepicker({
        dateFormat: 'yy-mm-dd', 
        changeMonth: false, 
        changeYear: false, 
        yearRange: '0:+2',
        minDate: 0,
    });
}