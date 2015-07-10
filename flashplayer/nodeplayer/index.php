<?php

//  $URL_ROOT = "http://clocktower.org/drupal";
//  $DRUPAL_URL = "http://clocktower.org/drupal";
//  $PATH_ROOT = "/var/www/vhosts/artonair.org/clocktower.org";

  $URL_ROOT = 'http://'.$_SERVER['SERVER_NAME'].'/drupal';
  $DRUPAL_URL = 'http://'.$_SERVER['SERVER_NAME'].'/drupal';
  $PATH_ROOT = $_SERVER['DOCUMENT_ROOT'];

  $DRUPAL_PATH = $PATH_ROOT . "/drupal";
  $URL = $URL_ROOT . "/flashplayer/nodeplayer";

  $nid = strip_tags($_GET["nid"]);
  chdir($DRUPAL_PATH);
  error_reporting(E_ALL);
  require_once "./includes/bootstrap.inc";
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

  global $base_url;

//  $referer  = $_SERVER['HTTP_REFERER'];
//  $series_path = str_replace($base_url . '/', '', $referer);
//  $source = drupal_lookup_path('source', $series_path);
//  $node_object = menu_get_object('node', 1, $source);

  include_once(path_to_theme() . '/custom_functions/custom_variable.php');


  function debug_to_console( $data ) {
      if ( is_array( $data ) )
          $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
      else
          $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
      echo $output;
  }

  $node = node_load($nid);
  $result = views_get_view_result("series_contents", "grid_related_shows", $_SESSION['series']['nid']);
  $resultcount = count($result);
  $nidd = $_SESSION['series']['nid'];
  $playlist = $DRUPAL_URL . "/sites/all/themes/artonair/custom_functions/node_playlist_xspf.php?nid=" . $nid;
  $full_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  debug_to_console($nidd);
  debug_to_console($resultcount);


  $prevnode = -1;
  $nextnode = -1;

  if($resultcount > 1) {
    for($i = 0; $i < $resultcount; $i++) {
      $showid = $result[$i]->node_node_data_field_included_shows_nid;
      debug_to_console($showid);
      debug_to_console($nid);
      if($nid == $result[$i]->node_node_data_field_included_shows_nid) {
        if($i < ($resultcount - 1)){
          $prevnode = $result[$i+1]->node_node_data_field_included_shows_nid;
          if($result[$i-1]){
            $nextnode = $result[$i-1]->node_node_data_field_included_shows_nid;
          }
        } elseif($i == ($resultcount - 1)) {
          $nextnode = $result[$i-1]->node_node_data_field_included_shows_nid;
        }
      }
    }
  }
?>

<html>

<head>

<title>
  <?php print $node->title; ?>
</title>

<link rel="stylesheet" href="<?php print $URL; ?>/style.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.5">

</head>

<script src="<?php print $URL; ?>/jquery-1.11.1.min.js"></script>

<script type="text/javascript">

<?php
  $playlist_contents = file_get_contents($playlist);
  $trimmed_playlist_contents = trim(preg_replace('/\s+/', ' ', $playlist_contents));

  print 'var xml = \''.addslashes(html_entity_decode($trimmed_playlist_contents)).'\';';
  print "var next_node = $prevnode;";
  print "var current_node = $nid;";
  print "var previous_node = $nextnode;";
?>

  xml = xml.replace(/&/g, '&amp;');

  var playlist = $($.parseXML(xml)),
      title    = playlist.find('title').first().text(),
      tracks   = playlist.find('tracklist track');

  var formatted_playlist = [];

  $('#playlist_title').text(title);

  tracks.each(function(){
      var t = $(this);
      console.log(t);
      formatted_playlist.push({
        file: t.find('location').text(),
        title: t.find('title').text(),
        artist: t.find('creator').text(),
        description: t.find('creator').text()
      });

  if(tracks.length == 1){
    $(function(){
      $('.track-artist').css('display', 'none');
    });
  }

  });

</script>

<script>
  // Automatically adjusts width of popup button container
  $(document).ready(function() {
    $popupButtons = $(".popup-buttons");
    resize($popupButtons);

    $(window).resize(function() {
      resize($popupButtons);
    });

    function resize($object) {
      var popupWidth = $(".top").width() - $(".logo").width() - 50;
      $object.css('width', popupWidth);
    };
  });
</script>

<script src="<?php print $URL; ?>/player.js"></script>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0"; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>

<div id="player">

  <div class="overlay">
    <div class="x"></div>
    <div class="embed">
      <h1>
        Embed this show
      </h1>
      <textarea><iframe width="400" height="512" src="<?php echo $full_link ?>?autoplay=false" frameborder="0"></iframe></textarea>
      <h2>
        Copy and paste the code above to embed this show on your website.
      </h2>
      <div class="social">
        <div class="fb-like" data-href="<?php echo $full_link ?>http://clocktower.org" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div>

        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="vertical">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      </div>
    </div>

    <div class="copy">
      <?php
        $doc = new DOMDocument();
        $doc->encoding = 'utf-8';
        $doc->loadHTML(utf8_decode(nl2br($node->field_summary[0]['safe']) . nl2br($node->body)));
        print $doc->saveHTML();
      ?>
    </div>

  </div>
  <section class="top group">

    <a href="http://clocktower.org" target="_new">
      <img class="logo" src="<?php print $URL; ?>/clocktowerlogo.png"/>
    </a>

    <div class="popup-buttons">

      <div class="more-info">
        <div></div>
        more info
      </div>

      <div class="share">
        <div></div>
        share
      </div>

    </div>

  </section>


  <section class="bottom group">

    <audio id="current-track"></audio>

    <div class="progress-bar">

      <div class="time">
        <span class="time-elapsed">&nbsp;</span>
        <span class="time-left">&nbsp;</span>
        <span class="total-time hide">&nbsp;</span>
      </div>

      <div class="bar">
        <div class="elapsed-bar">
          <div class="scrubber">
          </div>
        </div>
      </div>

    </div>

    <div class="track-title">
      Track: <span class="title"></span> <span class="track-count">-/-</span>
    </div>

    <div class="track-artist">
      Artist: <span class="artist"></span>
    </div>

    <div class="track-series">
      Series: <span class="series"><?php print(node_load($node->field_series[0])->title); ?></span>
    </div>

    <div class="track-show">
      Show: <span class="show"><?php print($node->title); ?><!-- – <?php print date("j/n/Y", strtotime($node->field_aired_date[0]['value'])); ?> --></span>
    </div>

    <div class="track-host">
      Host: <span class="host"><?php print(node_load($node->field_host[0])->title); ?></span>
    </div>

    <div class="player-controls group">
      <div class="previous buttons">
        <div class="previous-show">
          <div></div>
        </div>
        <div class="previous-track">
          <div></div>
        </div>
      </div>
      <div class="play-mode">
        <div class="pause hide">
          <div class="left box"></div>
          <div class="right box"></div>
        </div>
        <div class="play">
          <div></div>
        </div>
      </div>
      <div class="next buttons">
        <div class="next-track">
          <div></div>
        </div>
        <div class="next-show">
          <div></div>
        </div>
      </div>
    </div>

    <section/>

      <div class="volume loud"></div>

    </div>

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
