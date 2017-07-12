$(function() {
    // Date range filter    
    var table_axis = $("#table-axis-" + table_axis_class).DataTable();
    
    $('#min_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1        
    }).change(function() {         
        minDateFilter = new Date(this.value).getTime();       
        table_axis.draw();
    });
    
    $('#max_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1
    }).change(function() {
        maxDateFilter = new Date(this.value).getTime();
        table_axis.draw();
    });
    
});

var minDateFilter = '', maxDateFilter = '';

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTableExt.afnFiltering.push(
    function( settings, data, dataIndex ) {                                
        if (typeof data._date == 'undefined') {
            data._date = new Date(data[range_data_key]).getTime();
        }
       
        if (minDateFilter && !isNaN(minDateFilter)) {                
            if (data._date < minDateFilter) {                
                return false;
            }
        }

        if (maxDateFilter && !isNaN(maxDateFilter)) {                
            if (data._date > maxDateFilter) {                
                return false;
            }
        }

        return true;        
    }
);