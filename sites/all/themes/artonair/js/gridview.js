// this script is called for GRIDVIEW
// an exists() function already defined in script.js, which is called on every page.

$(document).ready(function() {

/* if you're hovering over thumbnails for the gridview teasers, display the teaser content */

  $(".gridview-image").hover(function() {  /* get thumbnail */

      var archiveview = false;
      if($(this).parents(".archive").length>0) archiveview = true; //archiveview

      $(this).parent().addClass('hovering'); /* mark teaser as hovering/displayable */
      var pos = $(this).position();
      var height = $(this).height(); /*calculate height and width of thumbnail */
      var width = $(this).width(); /*calculate height and width of thumbnail */
      /* add offset and position teaser underneath thumbnail */
      var teaserwidth = $(this).parent().children(".teaser").width();
      var teaserheight = $(this).parent().children(".teaser").height();

      if(archiveview == true) {
        if($(this).parents(".views-row").attr("class").match(/views-row-(\d+)/)[1] <= 14) { /* if hovering over item near the bottom of the archive (2nd row (* 7)) */
	  $(this).parent().children(".teaser").css({"left": (pos.left + width - teaserwidth + 5) + "px", "top": (pos.top + height) + "px" }); /* the 5 is the border-left of the image */
	  $(this).parent().addClass("hover-above");
	} else {
          $(this).parent().children(".teaser").css({"left": (pos.left + width - teaserwidth + 5) + "px", "top": (pos.top - teaserheight - 5) + "px" }); /* the 5 is the border-left of the image */
	  $(this).parent().addClass("hover-below");
	}
      }
      else {
        $(this).parent().children(".teaser").css({"left": (pos.left - 5) + "px", "top": (pos.top + height) + "px" }); /* the 5 is the border-left of the image */
      }

    }, function() {
      $(this).parent().removeClass('hovering');
    });

/*
  $(".gridview .teaser-archive").hover(function() {  // get thumbnail
      gridhoverteaser = true;
alert(gridhoverimage + " " + gridhoverteaser);
  }, function() {
      gridhoverteaser = false;
      if(gridhoverimage == false && gridhoverteaser == false) $(this).parent().removeClass('hovering');
alert(gridhoverimage + " " + gridhoverteaser);
  });
*/

});
