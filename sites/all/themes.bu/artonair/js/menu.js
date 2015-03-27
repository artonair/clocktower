function ShowHeaderMenu(menuname) {
    /* deals with hiding and showing the menu images and stuff */
    $(".air_header_menu_image").hide();
    $(".air_header_menu_link .pointy-arrow").hide();
    $("#menulink-" + menuname + " .pointy-arrow").show();
    $("#menuimage-" + menuname).show();
}

$(document).ready(function() {

  /* now, on page load, we set the default state for the menu link */
  var inithover;
  /* if we're on the new-this-week page, or on the front page, set to radionew.  */
  /* if we're on the clocktower gallery page, set to clocktowergallery.  */
  /* else -- set to radio archive. */

  if($("body").hasClass("front") || $("body").hasClass("section-new-this-week")) {
    inithover = "radionew";
  } else if($("body").hasClass("section-clocktower-gallery")) {
    inithover = "clocktowergallery";
  } else {
    inithover = "radioarchive";
  }

  ShowHeaderMenu(inithover);



  $(".air_header_menu .menu_links").hover(function() {
  }, function() {
    /* when the mouse exits out of the menu_links area, return back to the initial status */
    ShowHeaderMenu(inithover);
  });


  $(".air_header_menu .air_header_menu_link").hover(function() {
  /* if you're hovering over a menu link, show the appropriate image and pointy-arrow */
    var hovername = $(this).attr("id").split("-");
    ShowHeaderMenu(hovername[1]);
  });

});
