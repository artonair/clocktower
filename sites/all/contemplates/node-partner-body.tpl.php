<?php include_once('sites/all/themes/artonair/custom_functions/custom_variable.php');  /* mp3 folder path */ ?>
<?php include_once('sites/all/themes/artonair/custom_functions/default_image.php');  /* function for displaying default images */ ?>
<?php $listen_url = "/play/" . $node->nid . "/" . $node->path; ?> 


<?php global $base_url; 


   $vgvr = views_get_view_result('archive_popular', 'default'); 
   $node_status = "";
   foreach($vgvr as $vresult) {
      if($vresult->nid == $node->nid) $node_status = "Popular!";
   }

?>

<div class="<?php print $node->type; ?>-body bodyview">


   <div class="content-section">
  <!-- <div class="left-column"> -->
 <div class="left-column">
	<div class="header"> 
	
		<div class="info">

	   		<h6 class="type">
	   	      	<?php  $node_typename = "";
				if($node->type == "event") { ?>
	   	      	<span><?php print l("Events", "projects/events"); ?></span>
	      	    	<span class="dates">
	      				<?php if($node->field_event_date[0]['value']) { ?>
	      					<?php $artistcount = 0;
		  						foreach($node->field_event_date as $one_artist) {
		 	 		 			if($artistcount++ > 0 ) print " + ";
		  						print "<span class='single-artist'>" . $one_artist['view'] . "</span>";
							} ?>
	      				<?php } ?>
	    			</span><!-- /.dates -->
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "residency") { ?>
	      	    <span><?php print l("Residencies", "projects/residencies"); ?></span>
	   	      	<?php if($node->field_dates[0]['value']) { ?>
	    			<span class="dates">
	    		  <?php if($node->field_dates[0]['value'] == $node->field_dates[0]['value2']) print '';  else print ''; ?>
	      			<!--<span class="exhibited_date_itself"><?php //print $node->field_dates[0]['view']; ?></span>-->
	      			
	      			<span class="exhibited_date_itself"><?php print format_date(strtotime($node->field_dates[0]['value']), 'custom', 'F d',0); ?>
	      			&nbsp;&mdash;&nbsp;<?php print format_date(strtotime($node->field_dates[0]['value2']), 'custom', 'F d, Y',0); ?>
	      			</span>
	    			<?php } ?>
	    			</span><!-- /.dates -->
	  			<?php } ?>
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "exhibiton") { ?>
	      	    <?php print l("Exhibitions", "projects/exhibitions"); ?>
	   	      	<?php } ?> 
	   	      	
	   	      	<?php  $node_typename = "";
				if($node->type == "partner") { ?>
	      	    <span><?php print l("Institutional Partners", "about/partners"); ?></span>
	   	      	<?php } ?> 
	     	</h6><!-- /.type -->

	  		<div class="title">
				<h1><?php print $node->title; ?></h1>
    		</div><!-- /.title -->

		    <?php if($node->field_venue[0]['value']) { ?>
		    <div class="map-icon"><i class="icon icon-location"></i></div>
			<h6 class="venue"><?php print $node->field_venue[0]['value']; ?> <?php if($node->field_map_link[0]['value']) { ?>
			<span><a href="<?php print $node->field_map_link[0]['safe']; ?>" target="_blank">Map</a></span>
			<?php } ?>  </h6><!-- /.venue -->
	    	<?php } ?>
	    	
       </div> <!--  /.info -->
    </div><!-- /.header -->
</div> <!--left-column -->

<?php if($node->field_image[0]['view']) { ?>
<div class="right-column">
	<div class="header-image">		
			<div class="image"><?php print $node->field_image[0]['view']; ?>    </div>
		  	<div class="image-description"><?php print $node->field_image[0]['data']['description']; ?> </div>		 
	 </div><!-- /.header-image -->
</div><!-- /.right-column -->
<div class="left-column">
<?php } else { ?>
<div class="single-column">
	<?php } ?>
		<div class="share listen">
        <div class="social">
			
			<div class="addthis_toolbox addthis_default_style facebook"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a></div>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-520a6a3258c56e49"></script>
			
			<div class="twitter"> 
    			 <a href="https://twitter.com/share" class="twitter-share-button" data-via="clocktower_nyc">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    		 </div><!-- /.twitter -->
         
         </div> <!-- /.social -->
</div><!-- /.share.listen -->

	<div class="content">

      	<?php print $node->content['body']['#value']; ?>
      	<?php if($node->field_long_description[0]['view']) {  ?>
	      	<?php print $node->field_long_description[0]['view']; ?>
			<?php } ?>
			
			<?php if($node->field_support[0]['view']) {  ?>
			 	<div class="support">
				<em><?php print $node->field_support[0]['view']; ?></em>
				</div>
	    	<?php } ?>
	    
	    <div class="logo-image"><?php print $node->field_logo[0]['view']; ?>    </div>
	    
			<?php if($node->field_curators[0]['view']) {  ?>
	    		<h6 class="curator">Curated by 
				<?php $curatorcount = 0;
				foreach($node->field_curators as $one_curator) {
		  		if($curatorcount++ > 0) print ", ";
		  		print "<span class='curators'>" . $one_curator['view'] . "</span>";
				} ?>
	    		 </h6> <!-- /.curators -->
	  		<?php } ?>  

				
	    	<?php if($node->field_artists[0]['value']) {  ?>
			     <div class="artists">
					<?php $artistcount = 0;
		  			foreach($node->field_artists as $one_artist) {
		 			if($artistcount++ > 0) print "  ";
		  			print "<span>#" . $one_artist['view'] . "</span>";
					} ?>
	      		</div> <!-- /.artists -->
	    	<?php } ?>	   		
		</div><!-- /.content -->
</div><!-- /.left-column -->      

<div class="right-column">

		    <div class="image-gallery">
		<?php if($node->field_image[12]['view']) { ?>    
			<div class="thumbnails three">
				<?php print views_embed_view('exhibition_thumbnails_slider', 'default', $node->nid); ?>	
    		</div>
    	<?php
		  } else { ?>
		  <?php if($node->field_image[1]['view']) { ?>    
			<div class="thumbnails">
				<?php print views_embed_view('exhibition_thumbnails_slider', 'default', $node->nid); ?>	
    		</div>
			  	
		 <?php } ?>
		 <?php } ?>
		 
    </div><!-- /.image-gallery --> 	    


</div>    <!-- /.bodyview -->



 <?php if($node->type !== "news") { ?>
   <div class="also-list related">
            
	<?php print views_embed_view('clocktower_related_radio', 'related_to_event', $node->nid); ?>
    
  </div> <!-- also-list -->
  <?php } ?>


<!-- for addthis analytics -->

<div id="nid-for-javascript" style="display:none;"><?php print $node->nid; ?></div>



