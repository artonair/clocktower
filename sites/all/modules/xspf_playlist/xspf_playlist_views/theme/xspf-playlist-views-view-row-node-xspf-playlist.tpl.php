<?php

/**
 * @file xspf-playlist-views-view-row-node-xspf-playlist.tpl.php
 * Default view template to display a item in an XSPF playlist.
 *
 * @ingroup views_templates
 */

?>
<?php foreach($row as $item): ?>
  <track>
    <?php print format_xml_elements($item); ?>
  </track>
<?php endforeach; ?>