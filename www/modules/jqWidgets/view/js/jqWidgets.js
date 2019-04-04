$(document).ready(function() {
    $.ajax({
        url: "api/projects",  //LOAD PROJECTS
        type: 'GET',
        beforeSend: function (xhr) {
			xhr.setRequestHeader ("Authorization", Cookies.get('token'));
		},
        success: function (data) {
            data=JSON.parse(data);
            jqWidgetData=data[0];
            var dataFieldsArray=[];
            var dataColumnsArray=[];
            var dataType='string';
            $.each(jqWidgetData, function(key,value){
                if(isNaN(value)){
                    type='string';
                } else {
                    type='number';
                }
                dataFieldsArray.push({ name: key, type: dataType });
                dataColumnsArray.push({ text: key, dataField: key});
            });
            $('#allTableProjects').DataTable(); //Change table styles
            var url = "api/projects"; 
            var source =
            {
                dataType: 'array',
                localData: data,
                datafields: dataFieldsArray,
                id: 'id'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#allJqWidgetsProjectsDiv').jqxDataTable(
            {
                width: '100%',
                theme: 'metrodark',
                pagerButtonsCount: 10,
                source: dataAdapter,
                sortable: true,
                pageable: true,
                altRows: true,
                filterable: true,
                columnsResize: true,
                columns: dataColumnsArray
            }); 
        },
        error: function (data) {
            console.log(data);
        }
    });
});
