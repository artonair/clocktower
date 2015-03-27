<?php
#
# (c) 2008 BigSoft Limited
# Please retain this copyright message
# Software comes AS IS and without warrently
#
 
$title = "";
 
echo "<html><title>$title</title><body>";
echo "<h1>$title</h1>";
 
$dir = opendir(".");
while (($file = readdir($dir)) !== false)
{
        if ($file[0] == ".")
                continue;
        echo "<a href=\"$file\">$file</a></br>";
}
closedir($dir);
 
echo "</body></html>";
 
?>
