<?php $loadedrss = simplexml_load_file('http://www.live365.com/pls/front?viewType=xml&handle=artonair&cmd=view&handler=playlist');  ?>

<meta http-equiv="refresh" content="<?php print $loadedrss->Refresh; ?>">
<link type="text/css" rel="stylesheet" media="all" href="../css/nowplaying-iframe.css" />

<div class="info">
<?php
print "<span class=artist>" . $loadedrss->PlaylistEntry[0]->Artist . "</span> - <span class=title>" . $loadedrss->PlaylistEntry[0]->Title . "</span> - <span class=album>" . $loadedrss->PlaylistEntry[0]->Album ;
#print_r($loadedrss);
 ?>
</div>

