/// this script is called on every page.

jQuery(document).ready(function() {

 jQuery('#menuLink').click(function(){
    jQuery('#page').toggleClass('active');
  });

// Set header menu active-trail visible on page load
// This only sets the secondary list of the active trail to visible
//jQuery('ul.nice-menu li.active-trail ul').show();
//jQuery('ul.nice-menu li.active-trail ul').css('visibility', 'visible');

// hide slideshow content until page loads
//jQuery('#block-views-front_v2-front_slider').css('visibility', 'visible');
//jQuery('#block-views-radio_section-block_1').css('visibility', 'visible');
//jQuery('#views-nivo-slider-front_v2-small_slider').css('visibility', 'visible');

//add color coding to sidebar menu
jQuery('.menu a.projects').parent('li').addClass('projects');
jQuery('.menu a.radio').parent('li').addClass('radio');
jQuery('.menu a.about').parent('li').addClass('about');

//toggle classes for series index accordion dropdown icons

 jQuery('.accordion-header').click(function(){
    jQuery(this).children().toggleClass('icon-delete-alt');
  });

jQuery( '.accordion-header' ).first().children().addClass('icon-delete-alt');


//replace node type for radio in front page slider
jQuery('.slide .show h6.type span').replaceWith( "<span>Radio</span>" );
jQuery('.slide .series h6.type span').replaceWith( "<span>Radio</span>" );


// add 4-column masonry to related content when 4 or more results
jQuery('.also-list.related .views-row-4').parent('div').addClass('four');


//jQuery(function(){
//    var paging = window.location.pathname;
 //   var string = '?page=';

   //   jQuery( ".attachment.attachment-before" ).css('display', 'none !important');
 //   });


jQuery('.view-id-productions.view-display-id-page_1 .views-row-6').parent('div').removeClass('two');

//add sticky to views rows
jQuery('.node.sticky.node-teaser').parent('div').addClass('sticky');

//add project class to "news" included show view
jQuery('.node.node-teaser.node-type-exhibition').parent('div').addClass('project');
jQuery('.node.node-teaser.node-type-residency').parent('div').addClass('project');
jQuery('.node.node-teaser.node-type-event').parent('div').addClass('project');

// hide dropdown series archive content until page loads
//jQuery('.view-radio-category-index .accordion-content').css('visibility', 'visible');

// hide jcarosel slider content until page loads
//jQuery('.view-id-clocktower_radio_sidebar .jcarousel-skin-default .jcarousel-clip-horizontal').css('visibility', 'visible');
//jQuery('.view-most-viewed-series-slider .jcarousel-skin-default .jcarousel-clip-horizontal').css('visibility', 'visible');

// swap logo background on hover
    jQuery('#logo a').hover( 
	function () {
        jQuery('.logo-span').addClass('active');
	},
	function () {
        jQuery('.logo-span').removeClass('active');
    });


// this is for mouseover display of the in-page listen button

  jQuery(".listen .listen-button").hover(function() {
    jQuery(".listen .listen-display").fadeIn(250); 
  }, function() {
    jQuery(".listen .listen-display").fadeOut(250); 
  });
  
  jQuery("img.listen-img").hover(function() {
  	jQuery(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/triangle.png");
		}, function() {
	jQuery(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/menu_play.png");
});

  jQuery("img.listen-imgsm").hover(function() {
  	jQuery(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/triangle.png");
		}, function() {
	jQuery(this).attr("src","http://artonair.org/sites/all/themes/artonair/images/menu_play.png");
});


//open search bar in overlay window

  jQuery("#block-block-55 #search-icon").bind('mouseenter', function() {
    jQuery("#block-block-55 #search-box").fadeIn(250); 
  jQuery("#block-block-55 #search-icon").css('border-color', '#EEEEEE');   
  });
   jQuery("#block-block-55").bind('mouseleave', function() {
    jQuery("#block-block-55 #search-box").fadeOut(250); 
	jQuery("#block-block-55 #search-icon").css('border-color', '#FFFFFF'); 
 });

//open grid-view listen links in popup window
jQuery(".gallery-grid .listen a").attr('onClick', 'popUpAIR(this.href,"fixed", 570, 440); return false;');

jQuery(".archive-index-series-categories-overlay").hover(function() {
	jQuery(this).addClass('hovering');
});

jQuery("img#nivoslider-gallery").css('display', 'block !important');

jQuery("img#nivoslider").css('display', 'block !important');

jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop()) {
        jQuery('#toTop').fadeIn();
    } else {
        jQuery('#toTop').fadeOut();
    }
});

$("#toTop").click(function () {
   //1 second of animation time
   //html works for FFX but not Chrome
   //body works for Chrome but not FFX
   //This strange selector seems to work universally
   $("html, body").animate({scrollTop: 0}, 1000);
});

jQuery("img").load(function() {
	// initialize masonry grid 
	 var container = document.querySelector('.masonry');
	 var msnry = new Masonry( container, {
	 // options
	 columnWidth: 10,
	//gutter: 10,
	 itemSelector: '.item'
	});
			
});// end img load

}); //end ready
