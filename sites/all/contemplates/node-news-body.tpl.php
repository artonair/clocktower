<?php include_once('sites/all/themes/artonair/custom_functions/custom_variable.php');  /* mp3 folder path */ ?>
<?php include_once('sites/all/themes/artonair/custom_functions/default_image.php');  /* function for displaying default images */ ?>
<?php $listen_url = "/drupal/play/" . $node->nid . "/" . $node->path; ?>


<?php global $base_url;


   $vgvr = views_get_view_result('archive_popular', 'default');
   $node_status = "";
   foreach($vgvr as $vresult) {
      if($vresult->nid == $node->nid) $node_status = "Popular!";
   }

?>

<div class="<?php print $node->type; ?>-body bodyview">


  <div class="content-section">
 <div class="left-column" id="header-info">

	<div class="header">

		<div class="info">

	   		<h6 class="type">
	     		<?php if($node->type == "exhibition") { ?>
	     		<span><?php print l("Exhibition", "projects/exhibitions"); ?></span>
	     		<?php } ?>

	     		<?php if($node->field_series[0]['view']) { ?>
	     		<span><?php print l("Radio Show", "radio"); ?></span>
	     		<?php print $node->field_series[0]['view']; ?>
	     		<?php } ?>

				<?php if($node->type == "series") { ?>
				<span><?php print l("Radio Series", "radio/series"); ?></span><?php $view = views_get_view('series_contents');
							 $args = array($node->nid);
							 $view->set_display('default', $args); // like 'block_1'
							 $view->render();   ?>
							<div class="episode-count"><?php print sizeof($view->result);?> Episodes</div>
				<?php } ?>

	     		<?php if($node->type == "blog") { ?>
	     		<span><?php print l("News", "news"); ?></span>
	     		<?php } ?>

	     		<?php if($node->type == "host") { ?>
	     		<span><?php print l("People", "radio/hosts"); ?></span><?php $view = views_get_view('series_contents');
							 $args = array($node->nid);
							 $view->set_display('default', $args); // like 'block_1'
							 $view->render();   ?>
							<div class="episode-count"><?php print sizeof($view->result);?> Programs</div>
	     		<?php } ?>
	     	</h6><!-- /.type -->

			<?php if($node->type != "news") { ?>
	  		<div class="title">
				<h1><?php print $node->title; ?></h1>
    		</div><!-- /.title -->
			<?php } ?>



			<?php if($node->field_host[0]['view']) { ?>
		  		<h6 class="hosts">
			    	Hosted by <?php $hostno = 0; foreach ($node->field_host as $one_host) { ?>
	    		  	<?php if($hostno > 0) print "<span class='comma'>,</a>"; ?>
	    		 	 <span class="host"><?php print $one_host['view']; ?></span>
	    			<?php $hostno++; } ?>
	  			</h6>
			<?php } ?>

			<?php if(!empty($node->field_host_type[0]['view'])) { ?>
		  		<h6 class="host-types">
				    <?php $hosttypesno = 0; foreach ($node->field_host_type as $one_host_type) { ?>
				      <?php if($hosttypesno > 0) print "<span class='comma'>,</a>"; ?>
					      <span class="host-type"><?php print $one_host_type['view']; ?></span>
	    			<?php $hosttypesno++; } ?>
	  			</h6>
	  		<?php } ?>
	 </div> <!-- /.info -->
  </div><!-- /.header -->
</div> <!-- left-column -->

<?php if($node->type != "news") { ?>
<?php if($node->field_image[0]['view']) { ?>
<div class="right-column" id="header-image">
	<div class="header-image">
		<div class="image"><?php print $node->field_image[0]['view']; ?>    </div>
		  	<div class="image-description"><?php print $node->field_image[0]['data']['description']; ?> </div>
	 </div><!-- /.header-image -->
</div><!-- /.right-column -->
<?php } ?>
<div class="left-column" id="node-content">
      <div class="share listen">
    	  <?php  if($node->field_audio_path[0]['safe']) {   ?>
			<div class="play">
			  <div class="listen-button">
	    		<a href="<?php print $listen_url; ?>" onclick="popUpAIR(this.href,'fixed',570, 440); return false;" target="artonair_music_popup"><img src="<?php print $base_url; ?>/sites/all/themes/artonair/images/triangle-white.png"></a>
	    	  </div>
	    	  <div class="listen-text"><a href="<?php print $listen_url; ?>" onclick="popUpAIR(this.href,'fixed',570, 440); return false;" target="artonair_music_popup">Listen</a>
	    	</div>	<!-- /.listen-button -->
	    		<?php } ?>
		 </div><!-- /.play -->

        <div class="social">
			<div class="addthis_toolbox addthis_default_style facebook"><a class="addthis_button_facebook_share" fb:share:layout="button_count"></a></div>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-520a6a3258c56e49"></script>

			<div class="twitter">
    			 <a href="https://twitter.com/share" class="twitter-share-button" data-via="clocktower_nyc">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    		 </div><!-- /.twitter -->
         </div> <!-- /.social -->
	 </div><!-- /.share .listen -->

		<?php if($node->type == "series") {  ?>
			 <?php print views_embed_view('also_in_this_series', 'series_listen', $node->nid); ?>
		<?php } ?>

	<div class="content">
      	<?php print $node->content['body']['#value']; ?>

      	<?php if($node->field_long_description[0]['view']) {  ?>
	      	<?php print $node->field_long_description[0]['view']; ?>
		<?php } ?>

		<div class="content-foot">
		<?php if($node->field_support[0]['view']) {  ?>
			<em><?php print $node->field_support[0]['view']; ?></em>
	    <?php } ?>

		<?php if($node->type == "show") {  ?>
			<?php  if($node->field_aired_date[0]['view']) {   ?>
				<h6 class="aired_date">Originally aired <span class="aired_date_itself"><?php print $node->field_aired_date[0]['view']; ?></span></h6>
	  		<?php } ?>

			<div class="tags">
				<h6 class="category"><?php print views_embed_view("radio_categories", "radio_tags", $node->nid); ?></h6>
			</div>
		<?php } ?>

		<?php if($node->type == "series") {  ?>
		<h6 class="aired_date"><?php print views_embed_view('also_in_this_series', 'series_updated', $node->nid); ?></h6>
		<div class="tags">
			<h6 class="category"><?php print views_embed_view("radio_categories", "radio_tags", $node->nid); ?></h6>
		</div>
		<?php } ?>

		</div><!-- /.content-foot -->
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
     </div><!-- /.right-column -->
     <?php } ?>


  </div><!-- /.bodyview -->

  <?php if($node->type == "news") {  ?>
  <?php if (drupal_is_front_page()) { ?>

  <div class="banner-wrapper">
	  <div class="banner-news cycle">



		<?php print views_embed_view("in_this_news", "block_1", $node->nid); ?>

		<div class="nav-cycle">
	        <span id="prev"><i class="icon icon-left"></i></span>
	        <span id="next"><i class="icon icon-right"></i></span>
        </div>

	  </div><!-- .banner-news .cycle -->
	<div style="display:none">
		<a href="#" class="unslider-arrow prev">Previous slide</a>
		<a href="#" class="unslider-arrow next">Next slide</a>
	</div>
  </div>

  </div><!-- .banner-wrapper -->
  <?php } ?>

  <div class="in_this_news masonry">
   <div class="news-body">

   <!-- insert teaser -->
   <div class="news view-content">
   <div class="item">
   <div class="node-teaser node-type-<?php print $node->type?>">
 	<div class="header">
		<div class="info">
	   	      	<h2 class="title"><?php print $node->title; ?></h2>
	   	      	<h6 class="type"><span><?php print ("News"); ?></span></h6>
	   	      	<h6 class="dates"><?php print ("This Week"); ?></h6><!-- /.dates -->
        </div> <!-- /.info -->
    </div><!-- /.header -->
    <div class="teaser content">
		<?php print $node->content['body']['#value']; ?>
		<h6 class="read-more"><?php print l("More News", "news");?></h6>
	 </div> <!-- /.content -->

  </div> <!-- /.teaser -->
  </div> <!-- /.item -->
 </div><!-- end insert teaser /.view-content -->

  </div>
   <div class="featured_projects">
    <?php print views_embed_view("in_this_news", "default", $node->nid); ?>
  </div>

  	<div class="soundcloud item">
  		<?php $block = (object) module_invoke('block', 'block', 'view', "60");
		print theme('block',$block); ?>
	</div>

  	<div class="subscribe item">
  		<?php $block = (object) module_invoke('block', 'block', 'view', "42");
		print theme('block',$block); ?>
	</div>

  	<div class="subscribe item">
  		<?php $block = (object) module_invoke('block', 'block', 'view', "62");
		print theme('block',$block); ?>
	</div>
  	</div><!-- /.in-this-news -->

	  <div class="also-list">
	<div class="item block block-staffpicks">
	     <?php
			$view = views_get_view('staffpicks');
			print $view->preview('block_2');
			?>
		</div><!-- block-staffpicks -->

		<div class="item block block-popular">
	     <?php
			$view = views_get_view('most_viewed_sidebar');
			print $view->preview('block_2');
			?>
		</div><!-- block-popular -->

		<div class="item block block-news">
	     <?php
			$view = views_get_view('most_viewed_sidebar');
			print $view->preview('block_3');
			?>
		</div><!-- block-popular -->

	</div><!-- also-list -->

  <?php } ?>


  <?php if($node->type != "news") { ?>

  <?php $tags_display = views_embed_view('tags_for_node', 'default', $node->nid);  ?>


  <?php  } ?>


  <?php if($node->type == "show" && $node->field_series[0]['view']) { ?>

    <div class="also-list masonry">
      <div class="title item">
      	<h6>Other Episodes From</h6>
      	<h1><?php print $node->field_series[0]['view']; ?></h1>
      </div>

      <div class="series-contents">
		<?php print views_embed_view('also_in_this_series', 'grid_related_shows', $node->field_series[0]['nid'], $node->nid); ?>
      </div>
		</div><!-- also-list -->

	  <div class="also-list">
		<div class="block block-staffpicks">
	     <?php
			$view = views_get_view('staffpicks');
			print $view->preview('block_2');
			?>
		</div><!-- block-staffpicks -->

		<div class="block block-popular">
	     <?php
			$view = views_get_view('most_viewed_sidebar');
			print $view->preview('block_2');
			?>
		</div><!-- block-popular -->

	</div><!-- also-list -->
  <?php } ?>


  <?php if($node->type == "series") { ?>

    <div class="also-list masonry">

      	<div class="series-contents">
      	  <?php print views_embed_view('series_contents', 'grid_related_shows', $node->nid); ?>
      	</div>

    </div><!-- also-list -->

	  <div class="also-list">
		<div class="block block-staffpicks">
	     <?php
			$view = views_get_view('staffpicks');
			print $view->preview('block_2');
			?>
		</div><!-- block-staffpicks -->

		<div class="block block-popular">
	     <?php
			$view = views_get_view('most_viewed_sidebar');
			print $view->preview('block_2');
			?>
		</div><!-- block-popular -->

	</div><!-- also-list -->

  <?php } ?>


  <?php if($node->type == "host") { ?>

    <div class="also-list masonry">
      <div class="title item"><h1>Radio Featuring <?php print $node->title; ?></h1></div>

    <div class="by-this-host-browse smallgrid listview gridlist-choice-apply"> <!-- the gridlist choice applies to this div -->
        <?php print views_embed_view('by_this_host', 'of_this_host', $node->nid); ?>
        <?php print views_embed_view('by_this_host', 'block_2', $node->nid); ?>
    </div>

    </div>

  <?php } ?>


</div>

<!-- for addthis analytics -->

<div id="nid-for-javascript" style="display:none;"><?php print $node->nid; ?></div>



