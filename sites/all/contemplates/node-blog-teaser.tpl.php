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
<div class="<?php print $node->type?>-teaser teaser <?php
					foreach($node->taxonomy as $term) {
					  $your_vocabulary_id = 108;
					  if ($term->vid == $your_vocabulary_id) {
					    print $term->name;
					  }
					} ?>"> 
 	<div class="header"> 
		
		<?php  $node_typename = "";
				if($node->type != "news") { ?>
		<?php if ($node->taxonomy[13701]) { ?>
		<?php if($node->field_media_embed[0]['view']) { ?>
    					<div class="video"><?php print $node->field_media_embed[0]['view']; ?></div>
    					<?php } ?>
    					 	
				<?php } else { ?> 
		
				
		<div class="image">
   		<?php print $image_display_text; ?>
		</div><!-- /.image -->
		<?php } ?>
		<?php } ?>
		<div class="info">
	   		
	  		
	    		<?php  $node_typename = "";
				if($node->type == "news") : ?>
	   	      	<h3><?php print ("News This Week:"); ?></h3>
	   	      	<h2 class="title"><?php print $node->title; ?></h2>
	    	<?php else: /* Use /contact when empty */ ?>
	    	  <h2 class="title">
	    	  <?php print l($node->title, "node/" . $node->nid); ?>
	    	</h2><!-- /.title -->
	    	  <?php endif; ?>
			

          <h6 class="type">
	      		<?php  $node_typename = "";
				if($node->type == "blog") { ?>
	      	    <span><?php print ("News"); ?>
	   	      	<?php } ?> 
	   	      	
	      		
	     	</h6><!-- /.type -->
	<?php  $node_typename = "";
				if($node->type !== "news") : ?>
				<?php if($node->field_dates[0]['value']) { 
	   	      	?><h6 class="dates"><?php 
	    		  if($node->field_dates[0]['value'] == $node->field_dates[0]['value2']) print '';  else print ''; 
	    		  ?><span class="exhibited_date_itself"><?php print format_date(strtotime($node->field_dates[0]['value']), 'custom', 'M d',0); 
	    		  ?>&nbsp;-&nbsp;<?php print format_date(strtotime($node->field_dates[0]['value2']), 'custom', 'M d, Y',0); 
	    		  ?></span>
	    			<?php } ?>
	    			</h6><!-- /.dates -->
  <?php endif; ?>

	<?php if($node->type == "blog") { ?>
	
          <h6 class="dates"><?php
					foreach($node->taxonomy as $term) {
					  $your_vocabulary_id = 108;
					  if ($term->vid == $your_vocabulary_id) {
					    print $term->name;
					  }
					} ?></h6>
          <?php } ?>
  
 		 <?php  $node_typename = "";
				if($node->type == "show") { ?>
	   	      	
	   	      	<h6 class="series"><?php print $node->field_series[0]['view']; ?>	 </h6>
	   	   	<?php } ?>
				    	
	    <?php if(!empty($node->field_host_type[0]['view'])) { ?>
	  <h6 class="host-types">
	    
	    <?php $hosttypesno = 0; foreach ($node->field_host_type as $one_host_type) { ?>
	      <?php if($hosttypesno > 0) print "<span class='comma'>,</a>"; ?>
	      <?php print $one_host_type['view']; ?>
	    <?php $hosttypesno++; } ?>
	  </h6>
	  <?php } ?>
		
          <?php if($node->field_venue[0]['value']) { ?>
			<h6 class="venue">At <?php print $node->field_venue[0]['view']; ?></h6><!-- /.venue -->
	    	<?php } ?>
	    	
                    <?php if($node->field_partner_venue[0]['value']) { ?>
			<h6 class="venue">
				<?php $artistcount = 0;
		  			foreach($node->field_partner_venue as $one_artist) {
		 			if($artistcount++ > 0) print "  ";
		  			print "<span>" . $one_artist['safe'] . "</span>";
					} ?>

	    	</h6><!-- /.venue -->
	    	<?php } ?>
		
        </div> <!-- /.info -->
    
    </div><!-- /.header -->

    <div class="content"> 
    <?php  $node_typename = "";
				if($node->type !== "news") : ?>
				
	  <?php if($node->field_summary[0]['safe']) {
	    print $node->field_summary[0]['safe']; 
	    ?><h6 class="read-more"><?php print l("More", "node/" . $node->nid);?></h6><?php
	  } else { ?>
	    <p><?php print stringTruncate($node->content['body']['#value'], 220, " ", "..."); 
	    //  print $node->content['body']['#value']; 
	    ?></p>
	    <h6 class="read-more"><?php print l("More", "node/" . $node->nid);?></h6>
	    <?php } ?>
       
       <?php  if($node->field_audio_path[0]['safe']) {   ?>
		<div class="play">
		  <h6 class="play-button">
		  <div class="arrow"></div>
			<a href="<?php print $listen_url; ?>" onclick="popUpAIR(this.href,'fixed',570, 440); return false;" target="artonair_music_popup">Listen</a>
	    	
	  		</h6>
		 </div>
		  <div class="plus-button"><?php print $_COOKIE["air-playlist"]; ?></div>
		   <?php } ?>
<?php endif; ?>

<?php  $node_typename = "";
				if($node->type == "news") : ?>
<?php print $node->content['body']['#value']; ?>

      	<?php if($node->field_long_description[0]['view']) {  ?>
	      	<?php print $node->field_long_description[0]['view']; ?>
		<?php } ?>
<?php endif; ?>

       </div> <!-- /.content -->
 
  </div> <!-- /.teaser -->


