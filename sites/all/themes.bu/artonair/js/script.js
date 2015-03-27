/// this script is called on every page.

$(document).ready(function() {

// this is for mouseover display of the listen button

  $(".listen .listen-button").hover(function() {
    $(".listen .listen-display").fadeIn(250); 
  }, function() {
    $(".listen .listen-display").fadeOut(250); 
  });
  
  $("img.listen-img").hover(function() {
  	$(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/trianglehover.png");
		}, function() {
	$(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/triangle.png");
});

  $("img.listen-imgsm").hover(function() {
  	$(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/trianglehover.png");
		}, function() {
	$(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/triangle.png");
});

$(".archive-index-series-categories-overlay").hover(function() {
	$(this).addClass('hovering');
});

$("img#nivoslider-gallery").css('display', 'block !important');

$("img#nivoslider").css('display', 'block !important');

});
