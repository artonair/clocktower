<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> 
<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en'> 
<head> 
<!-- Website Design By: www.happyworm.com --> 
<title>Demo (jPlayer 1.2.0) : jPlayer as a stylish audio player</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<!--[if IE 6]>
<link href="../css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]--> 
<link rel="shortcut icon" href="../graphics/jplayer.ico" type="image/x-icon" /> 
 
<link href="jplayer.blue.monday.css" rel="stylesheet" type="text/css" /> 
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 
<script type="text/javascript" src="jquery.jplayer.min.js"></script> 
<script type="text/javascript"> 
<!--
$(document).ready(function(){
 
  // Local copy of jQuery selectors, for performance.
  var jpPlayTime = $("#jplayer_play_time");
  var jpTotalTime = $("#jplayer_total_time");
  var jpStatus = $("#demo_status"); // For displaying information about jPlayer's status in the demo page
  $("#jquery_jplayer").jPlayer({
    ready: function () {
//      this.element.jPlayer("setFile", "http://www.miaowmusic.com/audio/mp3/Miaow-07-Bubble.mp3", "http://www.miaowmusic.com/audio/ogg/Miaow-07-Bubble.ogg").jPlayer("play");

      this.element.jPlayer("setFile", "http://artonair.org/archives/mp3/sbmsonor03_sonoridade_tk07_nuvemboa.mp3").jPlayer("play");
    },
    volume: 50,
    oggSupport: true,
    preload: 'none'
  })
  .jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
    jpPlayTime.text($.jPlayer.convertTime(playedTime));
    jpTotalTime.text($.jPlayer.convertTime(totalTime));
 
  })
  .jPlayer("onSoundComplete", function() {
    this.element.jPlayer("play");
  });
});
-->
</script> 
</head> 
<body class="demos"> 
 
    <div id="jquery_jplayer"></div> 
 
    <div class="jp-single-player"> 
      <div class="jp-interface"> 
	<ul class="jp-controls"> 
	  <li><a href="#" id="jplayer_play" class="jp-play" tabindex="1">play</a></li> 
	  <li><a href="#" id="jplayer_pause" class="jp-pause" tabindex="1">pause</a></li> 
	  <li><a href="#" id="jplayer_stop" class="jp-stop" tabindex="1">stop</a></li> 
	  <li><a href="#" id="jplayer_volume_min" class="jp-volume-min" tabindex="1">min volume</a></li> 
	  <li><a href="#" id="jplayer_volume_max" class="jp-volume-max" tabindex="1">max volume</a></li> 
	</ul> 
	<div class="jp-progress"> 
	  <div id="jplayer_load_bar" class="jp-load-bar"> 
	    <div id="jplayer_play_bar" class="jp-play-bar"></div> 
	  </div> 
	</div> 
	<div id="jplayer_volume_bar" class="jp-volume-bar"> 
	  <div id="jplayer_volume_bar_value" class="jp-volume-bar-value"></div> 
	</div> 
	<div id="jplayer_play_time" class="jp-play-time"></div> 
	<div id="jplayer_total_time" class="jp-total-time"></div> 
      </div> 
      <div id="jplayer_playlist" class="jp-playlist"> 
	<ul> 
	  <li>Bubble</li> 
	</ul> 
      </div> 
    </div> 

</body> 
</html> 
