<?php 
/* generates an xspf playlist from a node's contained audio fields. */

error_reporting(E_ALL);
ini_set('display_errors', 1);

# print ini_get("open_basedir");

$nid = strip_tags($_GET["nid"]);

$DRUPAL_PATH = "/var/www/vhosts/artonair.org/clocktower.org/drupal";
chdir($DRUPAL_PATH);

require_once "./includes/bootstrap.inc";

drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

include_once(path_to_theme() . '/custom_functions/custom_variable.php');

$node = node_load($nid); 

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

print $playlisttext;

?>
