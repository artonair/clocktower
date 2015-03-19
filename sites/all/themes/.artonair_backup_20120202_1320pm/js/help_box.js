/* this is for the help_box drop-down, powered by cookies. */

$(document).ready(function() { 

    //if($("#help_box").exists()) {
    if($.cookie("show_help") != "hide" && $(".front").length>0) {
      $("#help_box").show();
    }

    $("#help_box .help_close").click(function() {
        $("#help_box").slideUp(300);
        $.cookie("show_help", "hide", { expires: 7 }); 
        $("#help_box_highlight").hide(300);
    });

    $(".help_link").click(function() {
        if($("#help_box").is(":visible")) {
          $("#help_box_highlight").fadeIn(200).fadeOut(200).fadeIn(200);
        }
        $("#help_box").slideDown(300);
        $.cookie("show_help", "show"); 
    }); 


});

