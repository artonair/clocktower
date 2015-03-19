/* this is for the sidebar right, which is almost always going to be the related nodes bar. */

$(document).ready(function() {

	//hover over teasers in sidebarview
	$(".sidebarview .teaser").hover(
	  function() {  $(this).addClass("hovering") }, function() { $(this).removeClass("hovering"); }
	); 

});
