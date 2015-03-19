<?php global $base_url; ?>

<div class="blurb-teaserbox teaserbox"><div class="teaserbox-inner">

  <div class="image-space">
  </div>

  <div class="title">
    <a href="<?php print $base_url . '/' . $node->path; ?>" title="<?php print $node->title ?>"><?php print $node->title; ?></a>
  </div>

  <div class="header">
    <div class="type"><a href="<?php print $base_url . "/archive/" . $node->type; ?>"><?php print $node->type; ?></a></div>
    <div class="node-status">Popular!</div>
  </div>

  
  <div class="info">
      <div class="producers">
	Produced by
	<?php foreach ($node->field_blurb_producer as $oneproducer) { ?>
	  <span class="producer"><?php print $oneproducer['view']; ?></span>
	<?php } ?>
      </div>
  </div>
  <div class="textcontent">
    <?php print $node->field_teaserbox_summary[0]['safe']; ?>
  </div>

</div></div>
