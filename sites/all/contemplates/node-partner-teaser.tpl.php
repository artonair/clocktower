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
<div class="<?php print $node->type?>-teaser teaser"> 
 	<div class="header"> 
		
		<?php  $node_typename = "";
				if($node->type != "news") : ?>
		<div class="image">
   		<?php print $image_display_text; ?>
		</div><!-- /.image -->
		<?php endif; ?>
		
		<div class="info">
	   		<h6 class="type">
	      		<?php  $node_typename = "";
				if($node->type == "residency") { ?>
	      	    <span><?php print ("Residencies"); ?></span> 
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "event") { ?>  
	      	    <span><?php print ("Events"); ?></span> 
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "partner") { ?>  
	      	    <span><?php print ("Institutional Partner"); ?></span> 
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "exhibition") { ?>
	      	    <span><?php print ("Exhibitions"); ?></span>
	   	      	<?php if($node->field_dates[0]['value']) { 
	   	      	?><span class="dates">&raquo;&nbsp;<?php 
	    		  if($node->field_dates[0]['value'] == $node->field_dates[0]['value2']) print '';  else print ''; 
	    		  ?><span class="exhibited_date_itself"><?php print format_date(strtotime($node->field_dates[0]['value']), 'custom', 'M d',0); 
	    		  ?>&nbsp;-&nbsp;<?php print format_date(strtotime($node->field_dates[0]['value2']), 'custom', 'M d, Y',0); 
	    		  ?></span>
	    			<?php } ?>
	    			</span><!-- /.dates -->
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "show") { ?>
				<span><?php print ("Radio"); ?></span>&nbsp;&raquo;&nbsp;<span class="series"><?php print $node->field_series[0]['view']; ?>	 </span>
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "series") { ?>
	   	      	<span><?php print ("Radio Series"); ?></span>&nbsp;&raquo;&nbsp;
						<?php $view = views_get_view('series_contents');    
						 $args = array($node->nid);
						 $view->render('default', $args);   ?>
						 
					<span class="episode-count"><?php print sizeof($view->result);?> Episodes</span>
				
	   	      	<?php } ?>
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "host") { ?>
	   	      	<span><?php print ("People"); ?></span>
	   	      	<?php } ?>
	   	      	

	     	</h6><!-- /.type -->

	  		<h2 class="title">
	    		<?php  $node_typename = "";
				if($node->type == "news") : ?>
	   	      	<?php print ("News This Week"); ?>
	   	      	
	    	<?php else: /* Use /contact when empty */ ?>
	    	  <?php print l($node->title, "node/" . $node->nid); ?>
	    	  <?php endif; ?>
			</h2><!-- /.title -->

          
				    	
	    <?php if(!empty($node->field_host_type[0]['view'])) { ?>
	  <div class="host-types">
	    
	    <?php $hosttypesno = 0; foreach ($node->field_host_type as $one_host_type) { ?>
	      <?php if($hosttypesno > 0) print "<span class='comma'>,</a>"; ?>
	      <span class="host-type"><?php print $one_host_type['view']; ?></span>
	    <?php $hosttypesno++; } ?>
	  </div>
	  <?php } ?>
		
          <?php if($node->field_venue[0]['value']) { ?>
			<h6 class="venue"><?php print $node->field_venue[0]['view']; ?></h6><!-- /.venue -->
	    	<?php } ?>
		
        </div> <!-- /.info -->
    
    </div><!-- /.header -->

    <div class="content"> 
	  <?php if($node->field_summary[0]['safe']) {
	    print $node->field_summary[0]['safe']; 
	    ?><h6 class="read-more"><?php print l("More", "node/" . $node->nid);?></h6><?php
	  } else { ?>
	    <p><?php print stringTruncate($node->content['body']['#value'], 220, " ", "..."); 
	    //  print $node->content['body']['#value']; 
	    ?></p>
	    <h6 class="read-more"><?php print l("More", "node/" . $node->nid);?></h6>
	    <?php } ?>
       
       
       </div> <!-- /.content -->
 
  </div> <!-- /.teaser -->


