<?php 
$data = "#EXTM3U\n";

/* generates an xspf playlist from a node's contained audio fields. */

$nid = strip_tags($_GET["nid"]);
//error_reporting(E_ALL);


$DRUPAL_PATH = "/var/www/vhosts/artonair.org/bu.artonair/drupal";

chdir($DRUPAL_PATH);
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

include_once('sites/all/themes/artonair/custom_functions/custom_variable.php');

$node = node_load($nid);

foreach($node->field_audio_path as $single_mp3) {

  getid3_load();
  $getID3 = new getID3;
  $ThisFileInfo = $getID3->analyze($air_mp3s_path . "/" . $single_mp3['value']);
  getid3_lib::CopyTagsToComments($ThisFileInfo);

$data .= "#EXTINF:,";
$data .= implode(": ", $ThisFileInfo['comments_html']['title']) . "\n"; 
$data .= $air_mp3s_url . "/" . $single_mp3['value'] . "\n";

}

header("Content-Type: audio/x-mpegurl");
header ( 'Content-Length: ' . strlen ( $data ) );
header('Content-Disposition: attachment; filename="playlist.m3u"');
print $data;
?>
