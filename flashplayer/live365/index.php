<?php
  if (preg_match("/(Anroid|iP(hone|od|ad))/i", $_SERVER['HTTP_USER_AGENT'])) { //if browser is iphone/ipad/
    header('Location: http://www.live365.com/play/artonair');
  }
  
?>

<!--
######################################################################################################
#
# Program:  Sample Live365 player window suitable for 3rd party customization.
#	This example is written in HTML with JavaScript coding.
#
# (c) Copyright 2003-10 Live365, Inc.
# 950 Tower Lane #1550
# Foster City, CA 94404.
# All rights reserved.
#
########################################################################################################
-->
<html>
<head>
<link rel="stylesheet" type="text/css" href="mini.css">
<meta http-equiv="Content-Language" content="en-us">
<title>Clocktower Radio | clocktower.org</title>

<link rel="stylesheet" href="live365-player.css" type="text/css" /> 
<link rel="stylesheet" href="http://clocktower.org/drupal/sites/all/themes/artonair/typography/FranklinGothic/stylesheet.css" type="text/css" /> 
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<script language="JavaScript">
<!-- start scripting

	var gVersion = "100.0.0.0";
	
// end scripting -->
</script>
<script language="JavaScript" src="http://www.live365.com/scripts/cookiemonster.js"></script>
<script language="JavaScript" src="http://www.live365.com/scripts/version.js"></script>
<script language="JavaScript" src="http://www.live365.com/scripts/clientdetect.js"></script>
<script language="JavaScript" src="http://www.live365.com/scripts/vb_sniff_lite.js"></script>
<script language="JavaScript" src="http://www.live365.com/scripts/hosts.js"></script>
<script language="JavaScript" src="http://www.live365.com/scripts/player.js"></script>
<script language="JavaScript" src="./customplayer.js"></script>
<script language="JavaScript" src="./onbeforeunload.js"></script>
<script language="JavaScript">
<!-- start scripting

/*** REQUIRED PARAMETERS ***/
station_broadcaster = 'artonair';  // DJ name
station_id          = 353240;       // station numeric ID
stream_id           = 1359302;        // stream numeric ID

/*** OPTIONAL PARAMETERS ***/														// CSS and images
local_css				= 'http://www.clocktower.org/drupal/flashplayer/live365/pls.css';	// CSS URL, has to be absolute
imageDir				= 'images/';												// Button images URL
gPreBtnVertSpace		= 4;														// Vertical offset above Play/Stop buttons in pixels
gPLSWidth				= 320;														// Width of Playlist iframe in pixels
gPLSHeight				= 80;														// Height of Playlist iframe in pixels
gPlayerColor			= '#000000';												// Color of visible embedded player in #RRGGBB



// end scripting -->


</script>	
</head>

<STYLE type="text/css" media="screen"><!--
--></STYLE>


<body bgcolor="#FFFFFF" onload="HandleAction('play');" scroll="yes">

<div id="container"><div id="container-inner">
<div class="header">
  <div class="air_logo"><a href="http://clocktower.org" target="_new"><img src="http://clocktower.org/drupal/sites/default/files/artonair_logo.png"></a><div class="logo-span"></div></div>
 <!--  <div class="streamheader">
    <div class="streamlogo"><img src="images/menu_play.png"></div>
    <div class="streamtitle"><div class="pointyarrow">&#9664;</div><div class="streamtext">Now playing</div></div>
  
  </div> -->
</div>

<div class="live365-player">
<script language="JavaScript">
<!-- start scripting
	DrawPLS("mode=1");			// Draw PLS track metadata
// end scripting -->
</script>



<div class="live365-playlist">
  <iframe marginwidth="0" marginheight="0" frameborder="no" scrolling="no" src="http://www.live365.com/mini/playlist.html?station=artonair&css=http://www.clocktower.org/drupal/flashplayer/live365-playlist/pls.css&hide=BW"></iframe>
</div>




    <div class="controls-logo">
      <div class="table">
	<div class="table-inner">
	  <table border="0" cellpadding="0" cellspacing="0">
	  <form name="controls">
	  <script language="JavaScript">
	  <!-- start scripting
		  DrawControls();
	  // end scripting -->
	  </script>
	  </form>
	  </table>
	</div>
      </div>
    </div>
</div>


</div>
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

