//FIXED SCROLL MENU BEGIN
$(window).scroll(function() {

	var homeUrl = 'http://axisproject.org/';

	if ( document.URL == homeUrl ){
	    if (checkVisible($('#home-menu'))) {
	        $('#scroll_menu').css("top", "-115px");
	        $(".home-about").css("padding-top","0");
	    } else {
	    	$('#scroll_menu').css("top", "0px");
	    	$(".home-about").css("padding-top","88px");
	    }
	}else{
		if (checkVisible($('.page-header'))) {
	        $('#scroll_menu').css("top", "-115px");
	    } else {
	    	$('#scroll_menu').css("top", "0px");
	    }
	} 

});

$(function(){

	var d = new Date();
	
	$('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: 1
        //startDate: new Date(d.setDate(d.getDate() - 1))
    }); 
    
});


function checkVisible( elm, eval ) {
    eval = eval || "visible";
    var vpH = $(window).height(), 
        st = $(window).scrollTop(), 
        y = $(elm).offset().top,
        elementHeight = $(elm).height();
    
    if (eval == "visible") return ((y < (vpH + st)) && (y > (st - elementHeight)));  
    if (eval == "above") return ((y < (vpH + st)));
}
//FIXED SCROLL MENU END


//MOBILE MENU BEGIN
$("#open_sider").click(function(){
	$(".sider").css("right","0");
	$(this).hide();
});

$("#close_sider").click(function(){
	$(".sider").css("right","-230px");
	$("#open_sider").show();
});
//MOBILE MENU END

//CONTROL MENU ON RESIZE BEGIN
$(window).resize(function() {
  	var width = $(window).width();
  	if(width > 1024){
    	$(".sider").css("right","-230px");
    	$("#open_sider").hide();
	}else{
		$("#open_sider").show();
	}
});  
//END

$(document).ready(function(){

	$("#join_us").click(function() {
		$("#join_section").show();
	    $('html, body').animate({
	        scrollTop: $("#join_section").offset().top
	    }, 2000);
	});

	$(".join_us").click(function() {
		$("#join_section").show();
	    $('html, body').animate({
	        scrollTop: $("#join_section").offset().top
	    }, 2000);
	});

	$('.program_modal').each(function(){
		$(this).on('hidden.bs.modal', function (e) {
		   $(this).find('iframe').attr("src", $(this).find('iframe').attr("src"));
		});
	});

	if(window.location.href.indexOf("programs/") > -1){
		if(window.location.hash){
			var hash = window.location.hash.substring(1);
	  		$("#"+hash).modal('show')
		}
	}
});
