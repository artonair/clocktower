// an exists() function.
jQuery.fn.exists = function(){return jQuery(this).length>0;}

function getArchiveNodeTypes()
{
    var types = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
	if(hash[0].match(/type/)) { types.push(hash[1]); }	
    }
    return types;
}

function slideArchiveMenu(func, targetname) {
    switch(func) {

        case 'up':
	      $(".archive-menu-inner ." + targetname + "-content").slideUp(300);
          $(".archive-menu-link." + targetname + " ." + targetname + "-status").text("+"); 
        break;

        case 'down':
	      $(".archive-menu-inner ." + targetname + "-content").slideDown(300);
          $(".archive-menu-link." + targetname + " ." + targetname + "-status").text("-"); 
        break;

        case 'toggle':
          if($(".archive-menu-link." + targetname + " ." + targetname + "-status").text() == "+") {
	   $(".archive-menu-link." + targetname + " ." + targetname + "-status").text("-"); 
 	   $(".archive-menu-inner ." + targetname + "-content").slideDown(300);
	} else { 
	   $(".archive-menu-link." + targetname + " ." + targetname + "-status").text("+"); 
 	   $(".archive-menu-inner ." + targetname + "-content").slideUp(300);
	}
        break;
    }        
} 


$(document).ready(function() {

/////////////////
// browse menu //
/////////////////


// highlight browse menu links if we're on a browse item in the archive (for example, 'featured this week by AIR', etc)
	if($(".view-archive-featured").exists()) $(".archive_featured_link").addClass("active");
	if($(".view-archive-most-viewed-week").exists()) $(".archive_most_viewed_week_link").addClass("active");
	if($(".view-archive-most-viewed-all").exists()) $(".archive_most_viewed_all_link").addClass("active");
	if($(".view-archive-most-discussed-week").exists()) $(".archive_most_discussed_week_link").addClass("active");
	if($(".view-archive-random").exists()) $(".archive_random_link").addClass("active");






// hosts in archive

	$(".archive-menu-link.hosts").click(function() { 
	  slideArchiveMenu("toggle", "hosts");
	  slideArchiveMenu("up", "tags");
	  slideArchiveMenu("up", "series");
	  slideArchiveMenu("up", "categories");
	}); 

// if we are on a category page then leave it open!
	var pathname = window.location.pathname; 

	if(pathname.search('/archive\/hosts/') != -1) {
	  $(".archive-menu-inner .hosts-content").show();
	  $(".archive-menu-link.hosts .hosts-status").text("-");
	}	 

//highlight hosts if active
	if($(".archive-menu-block .view-archive-hosts .tagadelic_views .active").exists()) { 
	  $(".archive-menu-link.hosts").addClass("active");
	}




// series in archive

	$(".archive-menu-link.series").click(function() { 
	  slideArchiveMenu("toggle", "series");
	  slideArchiveMenu("up", "tags");
	  slideArchiveMenu("up", "categories");
	  slideArchiveMenu("up", "hosts");
	}); 

// if we are on a series page then leave it open!
	var pathname = window.location.pathname; 

	if(pathname.search('/archive\/series/') != -1) {
	  $(".archive-menu-inner .series-content").show();
	  $(".archive-menu-link.series .series-status").text("-");
	}	 

//highlight series if active
	if($(".archive-menu-block .view-archive-series .tagadelic_views .active").exists()) { 
	  $(".archive-menu-link.series").addClass("active");
	}







// categories in archive

	$(".archive-menu-link.categories").click(function() { 
	  slideArchiveMenu("toggle", "categories");
	  slideArchiveMenu("up", "tags");
	  slideArchiveMenu("up", "hosts");
	  slideArchiveMenu("up", "series");
	}); 

// if we are on a category page then leave it open!
	var pathname = window.location.pathname; 

	if(pathname.search('/archive\/categories/') != -1) {
	  $(".archive-menu-inner .categories-content").show();
	  $(".archive-menu-link.categories .category-status").text("-");
	}	 

//highlight categories if active
	if($(".archive-menu-block .view-archive-categories .tagadelic_views .active").exists()) { 
	  $(".archive-menu-link.categories").addClass("active");
	}




// tags in archive
	$(".archive-menu-link.tags").click(function() { 
	  slideArchiveMenu("toggle", "tags");
	  slideArchiveMenu("up", "categories");
	  slideArchiveMenu("up", "hosts");
	  slideArchiveMenu("up", "series");
	});

// if we are on a tags page then leave it open!
	if(pathname.search('/archive\/tags/') != -1) {
	  $(".archive-menu-inner .tags-content").show();
	  $(".archive-menu-link.tags .tags-status").text("-");
	}	 


//highlight tags if active
	if($(".archive-menu-block .view-archive-tags .tagadelic_views .active").exists()) { 
	  $(".archive-menu-link.tags").addClass("active");
	}


/////////////////
// search menu //
/////////////////

// node type selection in archive
// check every checkbox
	$("#views-exposed-form-archive-page-1 .bef-checkboxes .option input:checkbox").attr('checked', 'checked');
	$("#views-exposed-form-archive-page-1 .bef-checkboxes .option").addClass('checked-label');
// and hide teh checkboxes
	$("#views-exposed-form-archive-page-1 .bef-checkboxes .option :checkbox").hide();




// THIS IS TO FIX this problem :  when going from a 'browse view' and directly using the search node-type boxes, the appropriate boxes don't light up.
// this fixes that.

      
	if($(".view-archive-audio").exists()) { 
	// if we're actually on the right view 

	  // uncheck every checkbox
	  archTypes = getArchiveNodeTypes();
	  
	  if(archTypes.length > 0) {
	    //if there's at least one checked
	    $("#views-exposed-form-archive-page-1 .bef-checkboxes .option input:checkbox").removeAttr('checked');
	    $("#views-exposed-form-archive-page-1 .bef-checkboxes .option").removeClass('checked-label');
	  }

	  for(var i = 0; i < archTypes.length ; i++) {
	    $("#views-exposed-form-archive-page-1 #edit-type-" + archTypes[i] + "-wrapper label").addClass('checked-label').find("input").attr('checked', 'checked'); 
	  } 
	} 




// if you're hovering over things, highlight them in a pretty way
	$("#views-exposed-form-archive-page-1 .bef-checkboxes label").hover(
	  function() { $(this).addClass('hovered-label'); }, function() { $(this).removeClass('hovered-label');  }
	);
	
	$("#views-exposed-form-archive-page-1 .bef-checkboxes label").click(function() {
// even if you click the label the checkbox checks itself. 
	   if($(this).find("input").is(':checked')) {     $(this).find("input").removeAttr('checked'); $(this).removeClass('checked-label'); }
	    else {  $(this).find("input").attr('checked', 'checked'); $(this).addClass('checked-label'); } 

	});

/*	//hover over teasers in archive
	$(".archive .teaser").hover(
	  function() {  $(this).addClass("hovering") }, function() { $(this).removeClass("hovering"); }
	);
*/



});

/*
Drupal.behaviors.AIRArchiveDisplay = function (context) {
	// this is done so that it will be called each time the DOM is loaded. this is especilaly so that AJAX calls via the exposed_views block will be treated properly.

	//hover over teasers in archive
	$(".archive .teaser").hover(
	  function() {  $(this).addClass("hovering") }, function() { $(this).removeClass("hovering"); }
	);

};  */
