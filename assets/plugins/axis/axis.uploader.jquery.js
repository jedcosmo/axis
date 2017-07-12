/*
 * @devloper: j.dymosco
 * @date: Sept. 19, 2016
 */
$(function(){
    //lets initialize the uploader plugin.
    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash',
        browse_button : 'media_featured_img',
        container: document.getElementById('media_uploader'),
        url : "/admin/media/upload",
        filters : {
            max_file_size : '10mb',
            mime_types: [
                {title : "Image files", extensions : "jpg,gif,png"},                            
            ]
        },
        multipart_params : {
            "csrf_axis_token" : csrf_token,                       
        },                    
        flash_swf_url : plugins_dir + '/Moxie.swf',                    
        silverlight_xap_url : plugins_dir + '/Moxie.xap',
        init: {
            PostInit: function() {

                document.getElementById('btn-submit').onclick = function() {
                    if( uploader.total.size > 0 ){                        
                        uploader.start(); 
                        return false;
                    }else{                       
                        return true;
                    }                    
                };
            },

            UploadProgress: function(up, file) {
                //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            
            FileUploaded: function(up, file, info) {
                var response = $.parseJSON(info.response);
                if( response.status === 'success' ){                    
                    $('form').find('#featured-img-path').val( response.full_path );
                    $('form').find('input[name="csrf_axis_token"]').val( response.csrf_new_token );
                    $('form').submit();                    
                }
            },

            Error: function(up, err) {                
                console.log( "\nError #" + err.code + ": " + err.message );
            }
        }
    });

    uploader.bind('FilesAdded', handleFilesAdded);
    uploader.init();

    //Handle files listing in queue..
    function handleFilesAdded(uploader, files){
        var maxfiles = 1;        
        for ( var i = 0 ; i < files.length ; i++ ) {
            //make sure that only one file to be added in the lists.
            if(uploader.files.length > maxfiles )
            {
                uploader.splice(maxfiles);  
                return;
            }else{
                if($( "#preview-img" ).children().length > 0){
                    $( "#preview-img" ).html('');
                }
            } 
            
            showImagePreview( files[ i ] );
        }
    }

    //this will show the preview image.
    function showImagePreview( f ){         
        var item = $( '<div id="'+ f.id +'"><a data-fileid="'+ f.id +'" class="btn btn-flat btn-danger" id="preview-remove-btn-img"><i class="fa fa-remove"></i> Remove</a></div>' ).prependTo( $( "#preview-img" ) );
        var image = $( new Image() ).appendTo( item );

        var preloader = new mOxie.Image();

        preloader.onload = function() {                        
            preloader.downsize( 300, 300 );                        
            image.prop( "src", preloader.getAsDataURL() );                        
        };

        preloader.load( f.getSource() );
    }

    $('#preview-img').on('click', 'a#preview-remove-btn-img', function(){
        var previed_img_id = $(this).data('fileid');

        uploader.splice( previed_img_id );    
        uploader.refresh();

        $('#preview-img').find('div#' + previed_img_id).remove();
    });
    
    $('button#preview-edit-remove-btn-img').on('click', function(e){ 
        e.stopPropagation();
        $('#preview-img').html('');
        $('form').find('#featured-img-path').val('');
        $('#remove-img-modal').modal('hide');
    });
});