$(document).ready(function() {

  function switchGridlistView($view, $delay) {  /*function to change views. yay let's make our code neater! */
	if($view == "grid") { $otherview = "list"; } else { $otherview = "grid"; }
	$(".gridlist-chooser .view-choice-" + $otherview).removeClass("chosen");
	$(".gridlist-chooser .view-choice-" + $view).addClass("chosen");
	$(".gridlist-choice-apply").fadeOut($delay, function() { $(this).removeClass($otherview + "view").addClass($view + "view");  }).fadeIn($delay);
  }

/* for bodyview. separate to implement separate cookies. */ 
 
  if($(".bodyview .gridlist-chooser").length>0 && !($(".bodyview .gridlist-chooser .gridlist-chooser-dontremember"))) { /* don't use if we don't want to remember with cookies*/

    if($.cookie("gridlist-chooser-bodyview") == "grid") { switchGridlistView("grid", 0); } else {  switchGridlistView("list", 0);  }
  }

  $(".bodyview .gridlist-chooser .view-choice-grid").click(function() {
    $.cookie("gridlist-chooser-bodyview", "grid", { expires: 7 }); 
    switchGridlistView("grid", 300);
  });

  $(".bodyview .gridlist-chooser .view-choice-list").click(function() {
    $.cookie("gridlist-chooser-bodyview", "list", { expires: 7 }); 
    switchGridlistView("list", 300);
  });
  


  

/* for archive. separate to implement separate cookies. */ 
 
  if($(".archive .gridlist-chooser").length>0) {
    if($.cookie("gridlist-chooser-archive") == "grid") { switchGridlistView("grid", 0); } else {  switchGridlistView("list", 0);  }
  }

  $(".archive .gridlist-chooser .view-choice-grid").click(function() {
    $.cookie("gridlist-chooser-archive", "grid", { expires: 7 }); 
    switchGridlistView("grid", 300);
//    $(".gridlist-choice-apply").removeClass("listview").addClass("gridview"); 
  });

  $(".archive .gridlist-chooser .view-choice-list").click(function() {
    $.cookie("gridlist-chooser-archive", "list", { expires: 7 }); 
    switchGridlistView("list", 300);
//    $(".gridlist-choice-apply").removeClass("gridview").addClass("listview"); 
  });
  

});

