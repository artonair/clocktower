<?php

$URL_ROOT = "http://artonair.org";
$DRUPAL_URL = "http://artonair.org";
$PATH_ROOT = "/usr/local/www/apache22/data";
$DRUPAL_PATH = $PATH_ROOT . "/drupal";
$FLASHPLAYER_URL = $URL_ROOT . "/flashplayer/nodeplayer";

$nid = strip_tags($_GET["nid"]);

if (preg_match("/iPad/i", $_SERVER['HTTP_USER_AGENT'])) { //if browser is iphone/ipad/
  header('Location: ' . $DRUPAL_URL . '/flashplayer/nodeplayer/m3u/' . $nid . '/playlist.m3u');
}


chdir($DRUPAL_PATH);
error_reporting(E_ALL);
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
global $base_url;

$mobile_status = mobile_tools_is_mobile_device();
if($mobile_status['type'] == mobile) { 
  header('Location: ' . $DRUPAL_URL . '/flashplayer/nodeplayer/m3u/' . $nid . '/playlist.m3u');
} 

include_once(path_to_theme() . '/custom_functions/custom_variable.php');


$node = node_load($nid); 

$playlist = $DRUPAL_URL . "/sites/all/themes/artonair/custom_functions/node_playlist_xspf.php?nid=" . $nid;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title><?php print $node->title; ?></title>

  <link rel="stylesheet" href="<?php print $base_url . '/' .  path_to_theme(); ?>/css/artonair-custom.css" type="text/css" /> 
  <link rel="stylesheet" href="<?php print $base_url . '/' .  path_to_theme(); ?>/typography/museoslab/stylesheet.css" type="text/css" /> 
  <link rel="stylesheet" href="<?php print $FLASHPLAYER_URL; ?>/css/nodeplayer.css" type="text/css" /> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type='text/javascript' src='<?php print $FLASHPLAYER_URL; ?>/js/nodeplayer.js'></script> 
 
  </head> 

<body> 

<div id="container">  

  <div class="box">

    <div class="air-logo"><a href="<?php print $base_url; ?>" target="_newnew"><img src="<?php print $FLASHPLAYER_URL; ?>/images/air_logo_text.png"></a></div>
    <div class="nodeplayer listview"><div class="teaser show-teaser">
    <?php $nodeprint= node_view($node, TRUE, FALSE, FALSE); 
#$nodeprint = preg_replace('/<a href="([^<]*)">([^<]*)<\/a>/Us', '$2', $nodeprint); 
$nodeprint = preg_replace('/(<a href=".*")(>.*<\/a>)/Us', '$1 target="_newnew" $2', $nodeprint); 
  print $nodeprint; ?>
    </div></div>

    <div class="air-showplayer">
      <div class="text">
	<?php print $node->body; ?>
      </div>
      <div class="player">
	<div id="playerplace"></div>
      </div>
      <div class="playlist" id="plstDat"></div>
    </div>

  </div> <!-- box -->

</div> <!-- container -->

<script type="text/javascript"> 

function createPlayer(theFile) { 
  var flashvars = { file:theFile, autostart: "true", repeat: "list", controlbar:"bottom", playlist:"none", 'playlistsize' : '0', 'skin' : '<?php print $URL_ROOT; ?>/flashplayer/nodeplayer/swf/stylish_slim.swf', 'lightcolor' : 'FFD200', 'backcolor' : '46C8DC', 'frontcolor' : '767676' , 'playerready' : 'playerReady' , plugins: "gapro-1" , 'gapro.accountid': 'UA-1385510-2', 'gapro.trackstarts': 'true', 'gapro.trackpercentage': 'true', 'gapro.tracktime': 'true' } 
  var params = { allowfullscreen:"true", allowscriptaccess:"always" }
  var attributes = { id:"player1",  name:"player1" }
  swfobject.embedSWF("<?php print $URL_ROOT; ?>/flashplayer/nodeplayer/swf/player.swf", "playerplace", "350", "30", "9.0.115", false, flashvars, params, attributes); 
}

<?php if(($playlist)) { ?> createPlayer('<?php print $playlist; ?>'); <?php } ?>
</script> 


<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1385510-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })(); 
</script>
</body> 

</html> 
