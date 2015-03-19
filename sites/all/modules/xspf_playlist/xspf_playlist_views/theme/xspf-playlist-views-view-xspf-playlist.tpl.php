<?php
/**
 * @file xspf-playlist-views-view-xspf-playlist.tpl.php
 * Default view template to display a an XSPF playlist.
 *
 * @ingroup views_templates
 */
?>
<?php print "<?xml"; ?> version="1.0" encoding="utf-8" <?php print "?>"; ?>

<playlist version="0" <?php print $namespaces; ?>>
  <title><?php print $title; ?></title>
  <link><?php print $link; ?></link>
  <info><?php print $info; ?></info>
  <annotation><?php print $annotation; ?></annotation>
  <trackList>
<?php print $items; ?>
  </trackList>
</playlist>