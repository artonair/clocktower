// this script is called on every page.

// an exists() function.
jQuery.fn.exists = function(){return jQuery(this).length>0;}

$(document).ready(function() {
  
// dialog for popup
	$("#play_airstream_open_link").click(function() { $("#play_airstream_popup").show(300); });
	$("#play_airstream_overlay").click(function() { $("#play_airstream_popup").hide(0); });
	$("#play_airstream_close_link").click(function() { $("#play_airstream_popup").hide(0); });


	$("#edit-search-theme-form-1").addClass("idleField");
	$("#edit-search-theme-form-1").focus(function() {
	    $(this).removeClass("idleField").addClass("focusField");  
	    if (this.value == this.defaultValue){  
		this.value = '';  
	    }  
	    if(this.value != this.defaultValue){  
		this.select();  
	    }  
        });  
	$("#edit-search-theme-form-1").blur(function() {
	    $(this).removeClass("focusField").addClass("idleField");  
	    if ($.trim(this.value) == ''){  
		this.value = this.defaultValue; //(this.defaultValue ? this.defaultValue : '');  
	    }  
	});  

});
