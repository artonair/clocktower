<?php include_once('sites/all/themes/artonair/custom_functions/string_truncate.php');  /* function for truncating strings */ ?> 
<?php $listen_url = "/play/" . $node->nid . "/" . $node->path; ?> 
<?php $image_display_text = "";
  		if($node->field_image[0]['view']) {
    	  $image_display_text = $node->field_image[0]['view'];
   		} else { 
          $image_display_text = "<div class='no-image'></div>";
   		} ?>



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
 
<?php if(empty($node->field_dates[0]['view'])) { ?> 
<div class="<?php print $node->type?>-teaser teaser upcoming">
<?php } ?>
 
 <?php if($node->field_dates[0]['value']) { 
	      	    ?><div class="<?php print $node->type?>-teaser teaser">
<?php } ?>
 
 	<div class="header"> 
		
		<div class="image">
   		<?php print $image_display_text; ?>
		</div><!-- /.image -->
		
		<div class="info">
		
			<h2 class="title">
	    	  <?php print l($node->title, "node/" . $node->nid); ?>
			</h2><!-- /.title -->
			
	   		<h6 class="type">
	      		<?php  $node_typename = "";
				if($node->type == "residency") { ?>
	      	    <span><?php print ("Residencies"); ?> </span>
	      	 
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "event") { ?>
	      	    <?php print ("Events"); ?> 
	   	      	<?php } ?> 
	     	</h6><!-- /.type -->

			<?php if($node->field_dates[0]['value']) { 
	      	    ?><h6 class="dates"><?php 
	      	    if($node->field_dates[0]['value'] == $node->field_dates[0]['value2']) print '';  else print ''; 
	      	    ?><span class="exhibited_date_itself"><?php print format_date(strtotime($node->field_dates[0]['value']), 'custom', 'M d',0); 
	      	    ?>&nbsp;-&nbsp;<?php print format_date(strtotime($node->field_dates[0]['value2']), 'custom', 'M d, Y',0); ?>
	      			</span>
	      				</h6><!-- /.dates -->
	    			<?php } else { ?>
	    		<h6 class="upcoming">Upcoming</h6>
	    		<?php } ?>

    <?php if($node->field_venue[0]['value']) { ?>
			<h6 class="venue">
				<?php print $node->field_venue[0]['view']; ?>
	    	</h6><!-- /.venue -->
	    	<?php } ?>

        </div> <!-- /.info -->
    
    </div><!-- /.header -->

    <div class="content"> 
	  <?php if($node->field_summary[0]['safe']) {
	    print $node->field_summary[0]['safe']; 
	    ?><h6 class="read-more"><?php print l("More", "node/" . $node->nid);?></h6><?php
	  } else {
	    print stringTruncate($node->content['body']['#value'], 220, " ", "..."); 
	    //  print $node->content['body']['#value']; 
	    ?><h6 class="read-more"><?php print l("More", "node/" . $node->nid);?></h6><?php
	  } ?>
       </div> <!-- /.content -->
 
  </div> <!-- /.teaser -->


