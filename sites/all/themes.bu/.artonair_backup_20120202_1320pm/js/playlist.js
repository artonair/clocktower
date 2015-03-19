$(document).ready(function() {

    $(".plus-button").click(function() { 
      var $playlist = $.cookie("air-playlist");
      if($playlist == null) { alert ("playlist was empty"); $playlist = "";}
	else { alert($playlist); }
      $.cookie("air-playlist", $playlist + "," + $("#nid-for-javascript").html(), { expires: 7});
    })

});



