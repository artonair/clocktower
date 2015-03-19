<?php include_once('sites/all/themes/artonair/custom_functions/string_truncate.php');  /* function for truncating strings */ ?> <?php include_once('sites/all/themes/artonair/custom_functions/default_image.php');  /* function for displaying default images */ ?>
<?php $listen_url = "http://artonair.org/play/" . $node->nid . "/" . $node->path; ?> 
<?php

  /* this is done so that the defaultImag isn't loaded twice, and thusso that the default image isn't changed twice. */
  if(preg_match("/clocktower-gallery/", drupal_get_path_alias($_GET['q'])) > 0) {
    $clocktowergallery_section = true;
  } else {
    $clocktowergallery_section = false;
  }

  $image_display_text = "";
  if($node->field_image[0]['view']) {
      $image_display_text = $node->field_image[0]['view'];

   } else { 
      if($node->type != "exhibition") {
      $image_display_text = defaultImage($node->type, "teaser", $node->nid);
      }
   } 

?>



<?php global $base_url;

    /* this checks each node against a views to get popular results. this may be expensive - but I think views caches this. */ 
/* JAN_24 DISABLE POPULAR STATUS UNTIL NEXT WEEK (JAN_31) 
 if($node->type != "exhibition") {
    $vgvr = views_get_view_result('archive', 'page_2');
    $node_status = "";
    foreach($vgvr as $vresult) {
       if($vresult->nid == $node->nid) $node_status = "Popular!";
    }
  }  */
 ?>
 
<div class="over-type"> 
      <?php if($node->type == "event" ) { ?>
       <div class="type">
	  <?php print "Events"; ?>
       </div> 
      <?php } ?>
<div class="gridview-image">
   <?php print $image_display_text; ?>
</div></div>
 
 
<div class="<?php print $node->type?>-teaser teaser">
 
  <div class="gridview-pointy-arrow arrow-top">&#9650;</div>
  <div class="wrapper">
 
      <?php if($node->type == "event" && $clocktowergallery_section == true) { ?>
       <div class="image">
	  <?php print $image_display_text; ?>
       </div> 
      <?php } ?>

<div class="header">
        <div class="header-inner">
	   <div class="type">
	      <?php  $node_typename = "";
		if($node->type == "event") { ?>
	       
	      	    <?php 
		  /*$node_typename = "Exhibition";*/
		 if(!empty($node->field_exhibition_type[0]['view'])) { $node_typename .= /*" >> " .*/ $node->field_exhibition_type[0]['view']; }
		print l($node_typename, "clocktower-gallery"); ?>
	      <?php } ?> 
	      <?php if($node->field_artists[0]['value']) {  ?> &raquo; 
		<?php $artistcount = 0;
		  foreach($node->field_artists as $one_artist) {
		  if($artistcount++ > 0 ) print ", ";
		  print "<span class='single-artist'>" . $one_artist['view'] . "</span>";
		} ?>
	    <?php } ?>

</div>
	    <?php /* JAN_24 DISABLE POPULAR STATUS UNTIL NEXT WEEK (JAN_31) 
	   <?php if($node_status && $node->type != "exhibition") { ?><div class="node-status"><?php print l($node_status, "archive/most-viewed/week"); ?></div><?php } ?>
	 */ ?> 
        </div>

     </div>


     <div class="inner"> <?php // this is so that the listen link stays at the right place ?>
       <div class="title">
	  <?php if($node->field_related_radio[0]['value']) {   /* things can only be played if they're playable... */ ?>
	    
	     <span class="listen" style="height: 22px; width: 16px;"><img src="http://artonair.org/sites/all/themes/artonair/images/radio-icona.png" class="listen-imgsm"></span> 
	  <?php } ?>
         <?php print l($node->title, "node/" . $node->nid); ?>
       </div>
 
       <div class="info">
           	  	  <?php if($node->field_event_date[0]['value']) { ?>
	    <div class="exhibited_date">
	      <?php if($node->field_event_date[0]['value']) print ''; ?>
	      <span class="exhibited_date_itself"><?php print $node->field_event_date[0]['view']; ?></span>
	    </div>
	  <?php } ?>

       </div>

      <?php if($node->type != "event" || $clocktowergallery_section == false) { ?>
       <div class="image">
	  <?php print $image_display_text; ?>
       </div> 
      <?php } ?>
 
       <div class="content"> 
	  <?php if($node->field_summary[0]['safe']) {
	    print $node->field_summary[0]['safe']; 
	    ?><span class="read-more"><?php print l("Read More", "node/" . $node->nid);?></span><?php
	  } else {
	    print stringTruncate($node->content['body']['#value'], 220, " ", "..."); 
	    //  print $node->content['body']['#value']; 
	    ?><span class="read-more"><?php print l("Read More", "node/" . $node->nid);?></span><?php
	  } ?>
       </div> 
    </div> 

     <?php /* ?> 
    <div class="links"> 
    <span class="read-more"><?php print l("Read More", "node/" . $node->nid);?></span><span class="or-listen"> or <span class="listen"><a href="<?php print $listen_url; ?>" onclick="popUpAIR(this.href,'fixed', 570, 400); return false;" target="artonair_music_popup">&#9654; Play!</a></span></span>  
    </div> 
<?php */ ?>
 
  </div> <!-- wrapper --> 
  <div class="gridview-pointy-arrow arrow-bottom">&#9660;</div>
 

</div>

