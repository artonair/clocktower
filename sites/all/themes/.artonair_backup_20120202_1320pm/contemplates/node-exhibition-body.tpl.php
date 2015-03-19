<?php include_once('sites/all/themes/artonair/custom_functions/custom_variable.php');  /* mp3 folder path */ ?>
<?php include_once('sites/all/themes/artonair/custom_functions/default_image.php');  /* function for displaying default images */ ?>
<?php $listen_url = "http://artonair.org/play/" . $node->nid . "/" . $node->path; ?> 


<?php global $base_url; 


   $vgvr = views_get_view_result('archive_popular', 'default'); 
   $node_status = "";
   foreach($vgvr as $vresult) {
      if($vresult->nid == $node->nid) $node_status = "Popular!";
   }

?>

<div class="<?php print $node->type; ?>-body bodyview">


  <div class="header-section">

  <?php if($node->type != "news") { ?>
      <div class="breadcrumbs">
	    <div class="crumb"><?php print l("Clocktower Gallery", "clocktower-gallery"); ?>
	    </div>
	    <?php if($node->field_exhibition_type[0]['view']) { ?>	
	      <div class="crumb">
	      >><?php print $node->field_exhibition_type[0]['view']; ?>	 
			      <?php } ?>
	      </div>
  <?php } ?>
  </div> 
  <!-- header-section -->

   <div class="content-section">
    <div class="left-column">


      <div class="image-section">
	  <?php if($node->field_image[0]['view']) {
		?><div class="image"><?php print $node->field_image[0]['view']; ?><div class="image-description"><?php print $node->field_image[0]['data']['description']; ?> </div></div>
	  <?php } ?>
	</div>
      
      
      <div class="exhibition-thumbnails">
	<?php print views_embed_view('exhibition_gallery_thumbnails', 'default', $node->nid); ?>	
      </div>

    </div> <!-- left-column -->


    <div class="right-column">


      <?php  if($node->field_audio_path[0]['safe']) {   ?>
	<div class="listen">
	  <div class="listen-button">
	    <a href="<?php print $listen_url; ?>" onclick="popUpAIR(this.href,'fixed',570, 440); return false;" target="artonair_music_popup"><img src="http://artonair.org/sites/all/themes/artonair/images/triangle.png" class="listen-img"></a>
	  </div>
	  <div class="listen-display">&#9664;<div class="text">Play!</div></div>
	  <div class="plus-button"><?php print $_COOKIE["air-playlist"]; ?></div>
	</div>
      <?php   } ?>

      <div class="title">
		<?php print $node->title; ?>
      </div>


            <div class="info">
	  <?php if($node->field_artists[0]['value']) {  ?>
	      <div class="artists-list">By
		<?php $artistcount = 0;
		  foreach($node->field_artists as $one_artist) {
		  if($artistcount++ > 0) print ", ";
		  print "<span class='single-artist'>" . $one_artist['view'] . "</span>";
		} ?>
	      </div> 
	    <?php } ?>
	  <?php if($node->field_curators[0]['view']) {  ?>
	      <div class="curators-list">Curated by
		<?php $curatorcount = 0;
		  foreach($node->field_curators as $one_curator) {
		  if($curatorcount++ > 0) print ", ";
		  print "<span class='single-curator'>" . $one_curator['view'] . "</span>";
		} ?>
	      </div> 
	  <?php } ?>
	  <?php if($node->field_dates[0]['value']) { ?>
	    <div class="exhibited_date">
	      <?php if($node->field_dates[0]['value'] == $node->field_dates[0]['value2']) print 'On view on ';  else print 'On view from'; ?>
	      <span class="exhibited_date_itself"><?php print $node->field_dates[0]['view']; ?></span>
	    </div>
	  <?php } ?>

      </div>
      
      
      <div class="content">
	<?php print $node->content['body']['#value']; ?>
      </div>
      
   <?php if($node->field_long_description[0]['view']) {  ?>
	<div class="long-description content">
      <?php    print $node->field_long_description[0]['view']; ?>
	</div>
      <?php } ?>
       
      <div class="share-like">
	<div class="addthis">
	  <!-- AddThis Button BEGIN -->
	  <div class="addthis_toolbox addthis_default_style" addthis:url="<?php print urlencode(url($node->path, array('absolute' => true))); ?>">
	    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	    <a class="addthis_button_tweet"></a>
	    <a class="addthis_counter addthis_pill_style"></a>
	  </div>
	  <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
	  <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=artonair"></script>
	  <!-- AddThis Button END -->

	</div>
	<!--<div class="fblike">
	  <iframe src="http://www.facebook.com/plugins/like.php?href=<?php print urlencode(url($node->path, array('absolute' => true))); ?>&amp;layout=standard&amp;show_faces=false&amp;width=250&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:35px;" allowTransparency="true"></iframe>
	</div> -->

      </div> <!-- share-like end -->


    </div> <!-- right-column -->
  </div> <!-- content-section -->

   <?php if($node->type == "exhibition") { ?>
  <div class="also-in-the-series-section">


    <div class="right-column">
      <div class="also-in-the-series-browse gridlist-choice-dontremember">
	<?php print views_embed_view('exhibition_related_events', 'default', $node->nid); ?>
      </div>
    </div>
  </div> <!-- also-in-the-series -->
  <?php } ?>


  <?php  if($node->disqus) { ?>
  <div class="comments-section">
    <div class="left-column">
      <div class="label">Comments</div>
    </div>
  </div>
  <?php }  ?>

</div>

<!-- for addthis analytics -->

<div id="nid-for-javascript" style="display:none;"><?php print $node->nid; ?></div>