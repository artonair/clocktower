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

  <?php if($node->type != "exhibition") { ?>
      <div class="breadcrumbs">
	    <div class="crumb"><?php print l("Radio Archive", "archive"); ?></div>
	    <?php if($node->field_series[0]['view']) { ?> 
	      <div class="crumb">
	      >>
	      <?php print $node->field_series[0]['view']; ?> 
	      </div>
	    <?php } ?>
	    <div class="crumb">
	      >>
	      <?php $node_typename = ""; $node_typename = node_get_types('name', $node);
	    if($node->type == "host") { 
		//if(!empty($node->field_host_type[0]['view'])) $node_typename = $node->field_host_type[0]['view']; 
		print l($node_typename, "archive/index/people"); 
	    } else {
		print l($node_typename, "archive", array('query' => 'keys=&type[]=' . $node->type)); 
	    } ?>
	    </div>
      </div>
  <?php } ?>

  </div> <!-- header-section -->

  <div class="content-section">
    <div class="left-column">


      <div class="image-section">
      <?php if($node->type != "news") { ?>
	<?php if($node->field_image[0]['view']) {
	      foreach($node->field_image as $one_image) {
	      ?><div class="image"><?php
	      print $one_image['view'];
	      ?><div class="image-description"><?php print $one_image['data']['description']; ?> </div></div><?php
	  }
	} else {
	  /* print default image here. must  conform to terms of imagecache bodyview_thumbnail's dimensions. (250px wide, 350px max tall) */ 
	  print defaultImage($node->type, "body");
        } ?>
      <?php } ?>
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
	<?php if($node->field_series[0]['view']) { ?><div class="series-title"><?php print $node->field_series[0]['view']; ?>:</div><?php } ?>
	<?php if($node->type == "news") { print l($node->title, $node->path); } 
	else { print $node->title;  } ?>
      </div>

      <?php if($node->type == "news") {  ?>
      <div class="news_slider">
	<?php print views_embed_view("news_slider_shows", "block_1", $node->nid); ?>
      </div>
      <?php } ?>

      <div class="info">
	  <?php if($node->field_host[0]['view']) { ?>
	  <div class="hosts">
	    Hosted by
	    <?php $hostno = 0; foreach ($node->field_host as $one_host) { ?>
	      <?php if($hostno > 0) print "<span class='comma'>,</a>"; ?>
	      <span class="host"><?php print $one_host['view']; ?></span>
	    <?php $hostno++; } ?>
	  </div>
	  <?php } ?>
	  <?php if(!empty($node->field_host_type[0]['view'])) { ?>
	  <div class="host-types">
	    
	    <?php $hosttypesno = 0; foreach ($node->field_host_type as $one_host_type) { ?>
	      <?php if($hosttypesno > 0) print "<span class='comma'>,</a>"; ?>
	      <span class="host-type"><?php print $one_host_type['view']; ?></span>
	    <?php $hosttypesno++; } ?>
	  </div>
	  <?php } ?>


	  <?php if(($node->field_aired_date[0]['value']) && $node->type != "exhibition") { ?>
	  <div class="aired_date">
	    Originally aired on
	    <span class="aired_date_itself"><?php print $node->field_aired_date[0]['view']; ?></span>
	  </div>
	  <?php } ?>

	  <?php if($node->type == "exhibition") { 
	    if($node->field_artists[0]['value']) {  ?>
	      <div class="artists-list">By
		<?php $artistcount = 0;
		  foreach($node->field_artists as $one_artist) {
		  if($artistcount++ > 0) print ", ";
		  print $one_artist['view'];
		} ?>
	      </div> 
	  <?php } ?>
	  <?php if($node->field_curators[0]['view']) {  ?>
	      <div class="curators-list">By
		<?php $curatorcount = 0;
		  foreach($node->field_curators as $one_curator) {
		  if($curatorcount++ > 0) print ", ";
		  print "<span class='single-curator'>" . $one_curator['view'] . "</span>";
		} ?>
	      </div> 
	  <?php } ?>
	  <?php if($node->field_dates[0]['value']) { ?>
	    <div class="exhibited_date">
	      On exhibition from 
	      <span class="exhibited_date_itself"><?php print_r($node->field_dates[0]['view']); ?></span>
	    </div>
	    <?php 
	    }

 
	  } ?>

      </div>

      <div class="content">
	<?php print $node->content['body']['#value']; ?>
      </div>
      

       
      <div class="share-like">
	<div class="addthis">
	  <!-- AddThis Button BEGIN -->
	  <div class="addthis_toolbox addthis_default_style" addthis:url="<?php print urlencode(url($node->path, array('absolute' => true))); ?>">
	    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	    <a class="addthis_button_tweet"></a>
	    <a class="addthis_counter addthis_pill_style"></a>
	  </div>
	  <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
	  <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=clocktowernyc"></script>
	  <!-- AddThis Button END -->

	</div>
	<!--<div class="fblike">
	  <iframe src="http://www.facebook.com/plugins/like.php?href=<?php print urlencode(url($node->path, array('absolute' => true))); ?>&amp;layout=standard&amp;show_faces=false&amp;width=250&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:35px;" allowTransparency="true"></iframe>
	</div> -->

      </div> <!-- share-like end -->


    </div> <!-- right-column -->
  </div> <!-- content-section -->

  <?php if($node->type == "news") {  ?>
  <div class="in_this_news">
    <?php print views_embed_view("in_this_news", "default", $node->nid); ?>
  </div>
  <?php } ?>


  <?php if($node->type != "exhibition" && $node->type != "news") { ?>

  <?php $tags_display = views_embed_view('tags_for_node', 'default', $node->nid);  ?>

  <div class="tags-section">
    <div class="left-column">
      <div class="label">Tags</div>
    </div>
    <div class="right-column">
      <div class="tags"><?php print $tags_display; ?> </div>
    </div>
  </div> <!-- tags-section -->
  <?php  } ?>


  <?php if($node->type == "show" && $node->field_series[0]['view']) { ?>
  <div class="also-in-the-series-section">
    <div class="left-column">
      <div class="label">Also in the Series</div>
      <div class="gridlist-chooser">
	<a class="view-choice-grid choice">Grid view</a> / <a class="view-choice-list choice chosen">List view</a>
      </div>
    </div>

    <div class="right-column">
      <div class="series-title"><?php print $node->field_series[0]['view']; ?></div>
      <div class="also-in-the-series-browse smallgrid listview gridlist-choice-apply gridlist-choice-dontremember">
	<?php print views_embed_view('also_in_this_series', 'default', $node->field_series[0]['nid'], $node->nid); ?>
      </div>
    </div>
  </div> <!-- also-in-the-series -->
  <?php } ?>


  <?php if($node->type == "series") { ?>

  <div class="in-this-series-section">
    <div class="left-column">
      <div class="label">In this Series</div>
      <div class="gridlist-chooser">
	<a class="view-choice-grid choice">Grid view</a> / <a class="view-choice-list choice chosen">List view</a>
      </div>
    </div>

    <div class="right-column">
      <div class="series-title"><?php print $node->field_series[0]['view']; ?></div>
      <div class="in-this-series-browse smallgrid listview gridlist-choice-apply"> <!-- the gridlist choice applies to this div -->
        <?php print views_embed_view('series_contents', 'default', $node->nid); ?>
      </div>
    </div>
  </div> <!-- in-this-series -->
  <?php } ?>


  <?php if($node->type == "host") { ?>

  <div class="by-this-host-section">
    <div class="left-column">
      <div class="label">Shows and Series<br /> by <?php print $node->title; ?></div>
      <div class="gridlist-chooser">
	<a class="view-choice-grid choice">Grid view</a> / <a class="view-choice-list choice chosen">List view</a>
      </div>
    </div>

    <div class="right-column">
      <div class="by-this-host-browse smallgrid listview gridlist-choice-apply"> <!-- the gridlist choice applies to this div -->
        <?php print views_embed_view('by_this_host', 'default', $node->nid); ?>
      </div>
    </div>
  </div> <!-- by-this-host -->

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



