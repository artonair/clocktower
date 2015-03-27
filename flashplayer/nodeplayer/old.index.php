<?php
$URL_ROOT = "http://clocktower.org/drupal";
$DRUPAL_URL = "http://clocktower.org/drupal";
$PATH_ROOT = "/var/www/vhosts/artonair.org/clocktower.org";
$DRUPAL_PATH = $PATH_ROOT . "/drupal";
$FLASHPLAYER_URL = $URL_ROOT . "/flashplayer/nodeplayer";
$nid = strip_tags($_GET["nid"]);
chdir($DRUPAL_PATH);
error_reporting(E_ALL);
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
global $base_url;
include_once(path_to_theme() . '/custom_functions/custom_variable.php');
$node = node_load($nid); 
$result = views_get_view_result("show_previous_in_series", "default", $node->nid); 
$playlist = $DRUPAL_URL . "/sites/all/themes/artonair/custom_functions/node_playlist_xspf.php?nid=" . $nid;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 

<meta name="viewport" content="initial-scale=0.75, maximum-scale=1">

<title><?php print $node->title; ?></title>

  <link rel="stylesheet" href="<?php print $base_url . '/' .  path_to_theme(); ?>/css/artonair-custom.css" type="text/css" /> 
  <link rel="stylesheet" href="<?php print $base_url . '/' .  path_to_theme(); ?>/typography/FranklinGothic/stylesheet.css" type="text/css" /> 
  <link rel="stylesheet" href="<?php print $FLASHPLAYER_URL; ?>/css/nodeplayer.css" type="text/css" /> 

<?php
$prevnode = -1;
if(count($result) > 1) {
  for($i = 0; $i <= count($result); $i++) {
    if($nid == $result[$i]->node_node_data_field_included_shows_nid) {
      if($i < (count($result) - 1)) $prevnode = $result[$i+1]->node_node_data_field_included_shows_nid;
    }
  }
}
?>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
function forwardPlayer() {
       <?php if($prevnode != -1) print "document.location.href='http://clocktower.org/drupal/play/$prevnode/'";  ?>    
}
</script> 
<!-- <script type='text/javascript' src='<?php print $FLASHPLAYER_URL; ?>/js/nodeplayer.js'></script> -->
<script src="http://jwpsrv.com/library/nEySqPVXEeK+IiIACusDuQ.js"></script>

<style>
  body {
    background-color: #f7f7f7;
  }
  .jwplaylistimg {
    display: none;
  }
  #player {
    margin-top: 4px;
    background-color: grey;
    color: #fff;
  }
  .jwplaylistcontainer {
    box-shadow: 0 0 4px #000;
  }
  #container {
    border-top: 4px solid #000;
    border-left: none;
    border-right: none;
    border-bottom: none;
    box-shadow: 2px 2px 7px #EEEEEE;
  }
  .box {
  }
  #playlist_title {
    font-style: italic;
  }
  .text {
    display: block;
    height: 120px;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 2px;
  }
  .imagecache-teaserview_thumbnail {
    width:20px;
  }
</style>
 
  </head> 

<body> 

<div id="container">  

  <div class="box">

    <div class="air-logo"><a href="<?php print $base_url; ?>" target="_newnew"><img style="width:200px;" src="/drupal/sites/default/files/artonair_logo.png"></a></div>


      <div id="playlist_title"></div>
    
    <!-- (old player: Remove) -->
    <div class="nodeplayer listview"><div class="teaser show-teaser">
    <?php /* $nodeprint= node_view($node, TRUE, FALSE, FALSE); 
    $nodeprint = preg_replace('/(<a href=".*")(>.*<\/a>)/Us', '$1 target="_newnew" $2', $nodeprint); 
  print $nodeprint; */ ?>
</div></div>

	<!-- New Player -->

	<div id="player">Loading the player ...</div>
	<script type="text/javascript">
          <?php
            $playlist_contents = file_get_contents($playlist);
            $trimmed_playlist_contents = trim(preg_replace('/\s+/', ' ', $playlist_contents));
	    print 'var xml = \''.addslashes(html_entity_decode($trimmed_playlist_contents)).'\';'
          ?>

	    xml = xml.replace(/&/g, '&amp;');
            //var xml = xml.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
            //  return '&#'+i.charCodeAt(0)+';';
            //});

            var playlist = $($.parseXML(xml)),		
                title    = playlist.find('title').first().text(),
                tracks   = playlist.find('tracklist track');

            var formatted_playlist = [];

            $('#playlist_title').text(title);
            
            tracks.each(function(){
              var t = $(this);
              formatted_playlist.push({
                file: t.find('location').text(),
                title: t.find('title').text(),
                description: t.find('creator').text()
              });
	    });
	    
      jwplayer("player").setup({
         width: 350,
         height: 120,
         autostart: true,
         primary: 'html5',
         allowPlaylistControl: true,
         playlist: formatted_playlist,
         listbar : {
           position: "bottom",
           size: 90,
         }
      });
      jwplayer().onPlaylistComplete(function(){
        forwardPlayer();
      });
	</script>

        <div class="text">
          <?php print $node->field_summary[0]['safe']; ?>
          <?php print $node->body; ?>
          
        </div>


<!--
    </div></div>
-->

  </div> <!-- box -->

</div> <!-- container -->

<script type="text/javascript"> 

/* (old player) Flash Fallback
function createPlayer(theFile) { 
  var flashvars = { file:theFile, autostart: "true", repeat: "list", controlbar:"bottom", playlist:"none", 'playlistsize' : '0', 'skin' : '<?php print $URL_ROOT; ?>/flashplayer/nodeplayer/swf/stylish_slim.swf', 'lightcolor' : '007F93', 'backcolor' : 'EEEEEE', 'frontcolor' : '767676' , 'playerready' : 'playerReady' , plugins: "gapro-1" , 'gapro.accountid': 'UA-1385510-2', 'gapro.trackstarts': 'true', 'gapro.trackpercentage': 'true', 'gapro.tracktime': 'true' } 
  var params = { allowfullscreen:"true", allowscriptaccess:"always" }
  var attributes = { id:"player1",  name:"player1" }
  swfobject.embedSWF("<?php print $URL_ROOT; ?>/flashplayer/nodeplayer/swf/player.swf", "playerplace", "350", "30", "9.0.115", false, flashvars, params, attributes); 
}

<?php if(($playlist)) { ?> createPlayer('<?php print $playlist; ?>'); <?php } ?>
*/

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
