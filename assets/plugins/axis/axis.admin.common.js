/*
 * @developer: j.dymosco
 * Common jQuery and JavaScripts for Axis admin should be encoded here.
 */
$(function() {
    $("#table-axis").DataTable();
    $("#table-axis-attendance").DataTable();
        
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.dtd.$removeEmpty['span'] = false;
    CKEDITOR.dtd.$removeEmpty['i'] = false;
    CKEDITOR.dtd.$removeEmpty['div'] = false;

    replaceEditor();

    var d = new Date();
    $('#start_datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1,
        startDate: new Date(d.setDate(d.getDate() - 1))
    });

    $('#end_datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1,
        startDate: new Date(d.setDate(d.getDate() - 1))
    });
    
    $('#start_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1        
    });

    $('#end_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1        
    });

    $('#dob').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1        
    });

    $('#activity_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1
        //startDate: new Date(d.setDate(d.getDate() - 1))
    });   

    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1
        //startDate: new Date(d.setDate(d.getDate() - 1))
    }); 

    $(".timepicker").timepicker({
      showInputs: false
    });
    
    $('#attendance_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1        
    });

    $('input[name="medicare_eligibility"]').on('click', function(){
        var val = $(this).val();
        var elem_status = $('#medicare_eligibility_status');
        var elem_medicare_number = $('#medicare_number');
        
        if(val === '1'){
            elem_status.removeClass('hidden');
            elem_medicare_number.removeClass('hidden');
        }else{
            $('input[name="medicare_eligibility_active"]').prop('checked', false); 
            elem_status.addClass('hidden');
            elem_medicare_number.addClass('hidden');
        }
    });
    
    $('input[name="medicaid_eligibility"]').on('click', function(){
        var val = $(this).val();
        var elem_field = $('#medicaid_no_field');
        
        if(val === '1'){
            elem_field.removeClass('hidden');
        }else{             
            elem_field.addClass('hidden');
        }
    });
    
    $('input[name="type_of_income"]').on('click', function(){
        var val = $(this).val();
        var elem_field = $('#other_income');
        
        if(val === 'other'){
            elem_field.removeClass('hidden');
        }else{             
            elem_field.addClass('hidden');
        }
    });
    
    $('input[name="is_member"]').on('click', function(){
       var newPrefix = 'N';
       var member_code = $('input[name="member_id"]').val();
       var checked = $(this).prop('checked');
       
       if( !checked ){
           member_code = member_code.replace('M', newPrefix);
           $(this).val( newPrefix );
       }else{
           member_code = member_code.replace(newPrefix, 'M');
           $(this).val( 'M' );
       }
       
       $('input[name="member_id"]').val( member_code );
    });


    $("#client_filter").change(function(){
        if($(this).val() !="" ){
            $("#demographic_filter").attr("disabled","disabled");
            $("#goals_filter").attr("disabled","disabled");
        }else{
            $("#demographic_filter").removeAttr("disabled");
            $("#goals_filter").removeAttr("disabled");
        }
    });

    $("#demographic_filter").change(function(){
        if($(this).val() !="" ){
            $("#client_filter").attr("disabled","disabled");
            $("#goals_filter").attr("disabled","disabled");
        }else{
            $("#client_filter").removeAttr("disabled");
            $("#goals_filter").removeAttr("disabled");
        }
    });

    $("#goals_filter").change(function(){
        if($(this).val() !="" ){
            $("#client_filter").attr("disabled","disabled");
            $("#demographic_filter").attr("disabled","disabled");
        }else{
            $("#client_filter").removeAttr("disabled");
            $("#demographic_filter").removeAttr("disabled");
        }
    });
    
    /* Start of Client Attendance */
    $('#clients_search').typeahead({
        scrollBar: true,
        onSelect: function(item) {
            var element = '';  
            
            element = '<li class="attendee-'+ item.value +'"><input type="checkbox" checked="checked" value="'+ item.value +'" name="client_attendees[]" class="client_attendees"><span>'+ item.text +'</span> <div class="attendees-action"><a href="javascript:void(0);" data-attendee_id="' + item.value + '" class="remove label label-danger">Remove</a></div></li>';            
            $('.attendees-listing ul').prepend( element );
        },
        ajax: {
            url: "/admin/clients/autocomplete",
            timeout: 500,
            displayField: "client_name",
            valueField: "ID",
            triggerLength: 2,
            method: "get",
            loadingClass: "loading-circle",
            preDispatch: function (query) {
                $('.search-clients-loader').show();
                return {
                    search: query
                }
            },
            preProcess: function (data) {
                $('.search-clients-loader').hide();
                return data;
            }
        }
    });
    
    $('#clients_search').on('click, focus', function(){
        var self_val = $(this).val();
        
        if(self_val.length > 0){
            $(this).val('');
        }
    });
    
    $('#attendees-listing').on('click', 'a.remove', function(){
        var client_id = $(this).data('attendee_id');
        
        $(this).parents().find('.attendee-' + client_id).remove();
    });
    
    $('#form-create_daily_attendance').on('submit', function(){
        var form = $(this);
        
        if( form.find('input[name="attendance_date"]').val().length <= 0 && form.find('input[name="client_attendees[]"]').length <= 0){
            form.find('input[name="attendance_date"]').parent().addClass('has-danger');
            form.find('#attendees-listing').parent().addClass('has-danger');
            
            return false;
        }else if(form.find('input[name="attendance_date"]').val().length <= 0 || form.find('input[name="client_attendees[]"]').length <= 0){            
            if( form.find('input[name="attendance_date"]').val().length <= 0 ){
                form.find('input[name="attendance_date"]').parent().addClass('has-danger');
            }
            
            if( form.find('input[name="client_attendees[]"]').length <= 0 ){
                form.find('#attendees-listing').parent().addClass('has-danger');
            }
                          
            return false;
        }           
    });
    
    $('#table-axis-attendance').on('click', 'a.remove-attendance', function(){
        var url = $(this).data('redirect');        
        $('#remove-attendance-btn-modal').attr('data-attendance_delete_url', url);       
    });
    
    $('#remove-attendance-btn-modal').on('click', function(){
        var url = $(this).data('attendance_delete_url');
        window.location = url;
    });
    
    $('#set-attendance-completed').on('click', function(){
        var form = $('#form-create_daily_attendance');
        
        if( form.find('input[name="attendance_date"]').val().length <= 0 && form.find('input[name="client_attendees[]"]').length <= 0){
            form.find('input[name="attendance_date"]').parent().addClass('has-danger');
            form.find('#attendees-listing').parent().addClass('has-danger');
            
            return false;
        }else if(form.find('input[name="attendance_date"]').val().length <= 0 || form.find('input[name="client_attendees[]"]').length <= 0){            
            if( form.find('input[name="attendance_date"]').val().length <= 0 ){
                form.find('input[name="attendance_date"]').parent().addClass('has-danger');
            }
            
            if( form.find('input[name="client_attendees[]"]').length <= 0 ){
                form.find('#attendees-listing').parent().addClass('has-danger');
            }
                          
            return false;
        }
    });
    
    /*if($('input[name="attendance_status"]').length > 0){
        if( $('input[name="attendance_status"]').val() === 'completed' ){
            $('#attendees-listing a').hide();
        }
    }*/
    /* End of Client Attendance */
    
    $('#button-show-reports-options').on('click', function(){
        $('#reports-box-blocks').toggle();
    });
            
});

function replaceEditor(){
    if(window.location.href.indexOf("pages/") > -1) {
        /*
        CKEDITOR.replace('editor_NO');
        CKEDITOR.replace('editor_content2');
        CKEDITOR.replace('editor_content3');
        CKEDITOR.replace('editor_content4');
        CKEDITOR.replace('editor_content5');
        */

        CKEDITOR.replace( 'editor_NO', {
            extraPlugins: 'imageuploader'
        });
        CKEDITOR.replace( 'editor_content2', {
            extraPlugins: 'imageuploader'
        });
        CKEDITOR.replace( 'editor_content3', {
            extraPlugins: 'imageuploader'
        });
        CKEDITOR.replace( 'editor_content4', {
            extraPlugins: 'imageuploader'
        });
        CKEDITOR.replace( 'editor_content5', {
            extraPlugins: 'imageuploader'
        });
    }

    if(window.location.href.indexOf("blog/") > -1 || window.location.href.indexOf("events/") > -1 || window.location.href.indexOf("stories/") > -1 || window.location.href.indexOf("products/") > -1 || window.location.href.indexOf("team/") > -1) {        

        CKEDITOR.replace( 'editor_NO', {
            extraPlugins: 'imageuploader',
        });
    }
}


function addClientAttendance(url,activity_id,id){

    $("#add_"+id).css("cursor","default");
    $("#add_"+id).removeAttr("onclick");
    $("#add_"+id+" span").removeClass("label-success");
    $("#add_"+id+" span").addClass("label-info");
    $("#add_"+id+" span").html("<i title='Added' class='fa fa-check'></i> Added");

    $("#add_attendees").load(url+"admin/clientActivity/add_client_to_activity/"+activity_id+"-"+id).fadeIn("slow");
    $("#display_attendees").load(url+"admin/clientActivity/get_clients_by_activity_id/"+activity_id).fadeIn("slow");
    var controller = 'clientActivity';
    var method = 'get_clients_by_activity_id';
    reload(url, controller, method, activity_id);
}

function removeFromActivity(url, activity_id, client_id){

    $("#add_"+client_id).css("cursor","pointer");
    $("#add_"+client_id).attr("onclick","addClientAttendance('"+url+"', '"+activity_id+"', '"+client_id+"')");
    $("#add_"+client_id+" span").removeClass("label-info");
    $("#add_"+client_id+" span").addClass("label-success");
    $("#add_"+client_id+" span").html("<i title='Added' class='fa fa-plus'></i> Add");

    $("#add_attendees").load(url+"admin/clientActivity/remove_client_from_activity/"+activity_id+"-"+client_id).fadeIn("slow");
    $("#display_attendees").load(url+"admin/clientActivity/get_clients_by_activity_id/"+activity_id).fadeIn("slow");
    var controller = 'clientActivity';
    var method = 'get_clients_by_activity_id';
    reload(url, controller, method, activity_id);
}

function addClientEventAttendance(url,event_id,id){

    $("#add_"+id).css("cursor","default");
    $("#add_"+id).removeAttr("onclick");
    $("#add_"+id+" span").removeClass("label-success");
    $("#add_"+id+" span").addClass("label-info");
    $("#add_"+id+" span").html("<i title='Added' class='fa fa-check'></i> Added");

    $("#add_attendees").load(url+"admin/clientEvent/add_client_to_event/"+event_id+"-"+id).fadeIn("fast");
    $("#display_attendees").load(url+"admin/clientEvent/get_clients_by_event_id/"+event_id).fadeIn("fast");
    var controller = 'clientEvent';
    var method = 'get_clients_by_event_id';
    reload(url, controller, method, event_id);
}

function removeFromEvent(url, event_id, client_id){

    $("#add_"+client_id).css("cursor","pointer");
    $("#add_"+client_id).attr("onclick","addClientEventAttendance('"+url+"', '"+event_id+"', '"+client_id+"')");
    $("#add_"+client_id+" span").removeClass("label-info");
    $("#add_"+client_id+" span").addClass("label-success");
    $("#add_"+client_id+" span").html("<i title='Added' class='fa fa-plus'></i> Add");

    $("#add_attendees").load(url+"admin/clientEvent/remove_client_from_event/"+event_id+"-"+client_id).fadeIn("slow");
    $("#display_attendees").load(url+"admin/clientEvent/get_clients_by_event_id/"+event_id).fadeIn("slow");
    var controller = 'clientEvent';
    var method = 'get_clients_by_event_id';
    reload(url, controller, method, event_id);
}

function addNewClient(){
    $(".new_client_form").slideToggle();
}

function reload(url, controller, method, id){
    var $loader = $("#loader");
    if ($loader.is(":visible")) { return; }
    $loader.show();
    setTimeout(function() {
        $loader.hide();
        $("#display_attendees").load(url+"admin/"+controller+"/"+method+"/"+id).fadeIn("slow");
    }, 1000);
}