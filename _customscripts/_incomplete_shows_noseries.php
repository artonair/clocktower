<html> 
<body> 
<h1>ALL OF THESE SHOWS AREN'T CONNECTED TO A SERIES!</h1>
<h2>Gray entries are unpublished shows; work on published shows first.</h2>
<style type="text/css">
.unpublished,
.unpublished a {
COLOR: #999;
}
</style>

<?php

//* this is for mass editing nodes. only touch if you know what you'er doing */

error_reporting(E_ALL);
chdir('../');
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$result = db_query("SELECT n.nid FROM {node} n WHERE n.type = 'show'");

$rowcount = 0; $broadcastcount = 0; $m3ucount = 0; $legdated = 0;


while ($row = db_fetch_object($result)) {
  $rowcount++;
//  if($row->nid != 8460) continue;
//  if($row->nid != 9401 && $row->nid != 3238) continue;


  $node = node_load($row->nid, NULL, TRUE);

  if($node->status != 1) continue;
  if(!($node->field_series[0]['nid'])) { 
    if($node->status != 1) print "<div class='unpublished'>unpublished ::: ";
    //    print_r($node->field_aired_date); 
    //  }
    //print $rowcount . " :: " . 
    print "(" . l("edit", "node/" . $row->nid . "/edit", array('absolute' => true)) . ")  ---- " . l("$node->title", "node/" . $row->nid, array('absolute' => true)) . "<br />\n"; 
    $textmatch++;
    if($node->status != 1) print "</div>"; 
  }
}

print "$textmatch shows aren't connected to a series! (out of a total of $rowcount shows)<br/>\n";

?>
</body>
</html>
