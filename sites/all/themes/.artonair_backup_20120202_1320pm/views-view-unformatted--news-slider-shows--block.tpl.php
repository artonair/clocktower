<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 * 
 * this is done so that nivoslider works.
 */
?>
<?php drupal_add_js(path_to_theme() . "/js/jquery.nivo.slider.pack.js"); ?>
<?php drupal_add_css(path_to_theme() . "/nivo-slider/nivo-slider.css"); ?>
<?php drupal_add_css(path_to_theme() . "/nivo-slider/style-nivo-slider.css"); ?>
<script type="text/javascript">
    $(window).load(function() {
        $('#nivoslider').nivoSlider({
	  effect:'fade',
	  directionNavHide: false
	});
    });
</script>

<div id="nivoslider" class="nivoslider images">
<?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
<?php endforeach; ?>
</div>
