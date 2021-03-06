<?php 
/* generates an xspf playlist from a node's contained audio fields. */

$nid = strip_tags($_GET["nid"]);

$DRUPAL_PATH = "/var/www/vhosts/artonair.org/drupal";
chdir($DRUPAL_PATH);
include_once('sites/all/themes/artonair/custom_functions/custom_variable.php');

error_reporting(E_ALL);
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$node = node_load($nid); 

$xspf_filename = $air_xspfs_path . "/" . $nid . ".xspf";

$fmtime = filemtime($xspf_filename);

if((file_exists($xspf_filename)) && ($node->changed < $fmtime)) {
    /* if file is there, and drupal node hasn't changed since file has been created */
    include($xspf_filename);
} else {
/* file isn't there, or drupal node is more recent */
$playlisttext = '';

$playlisttext .= '<?xml version="1.0" encoding="UTF-8"?>
<playlist version="1" xmlns="http://xspf.org/ns/0/">
 <title>' . $node->title . '</title>
 <trackList>
';

foreach($node->field_audio_path as $single_mp3) {

  getid3_load();
  $getID3 = new getID3;
  $ThisFileInfo = $getID3->analyze(trim($air_mp3s_path . "/" . $single_mp3['value']));
  getid3_lib::CopyTagsToComments($ThisFileInfo);

  $playlisttext .= '   <track>
';

      if($ThisFileInfo['comments_html']['title']) { 
	$playlisttext .= '     <title>' . implode($ThisFileInfo['comments_html']['title'], ": ") . '</title>
';
      } else { /* if there are no id3 tags */
        $playlisttext .= '        <title></title>
';
      }
      if($ThisFileInfo['comments_html']['artist']) { 
	$playlisttext .= '     <creator>' . implode($ThisFileInfo['comments_html']['artist'], ": ") . '</creator>
';
      } else { /* if there are no id3 tags */
	$playlisttext .= '     <creator></creator>
';
      }
	$playlisttext .= '     <location>' . $air_mp3s_url . "/" . $single_mp3['value'] . '</location>
     <duration>' . ceil($ThisFileInfo['playtime_seconds']) . '</duration>
   </track>
';

}

$playlisttext .= '
 </trackList>
</playlist>
';

$fh = fopen($xspf_filename, 'w') or die("can't open file");
fwrite($fh, $playlisttext);
fclose($fh);
print $playlisttext;

} /* if file doesn't exist end bracket */
?>
