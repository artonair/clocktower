<html> 
<body> 
<?php

//* this is for mass editing nodes. only touch if you know what you'er doing */

chdir('../');

error_reporting(E_ALL);
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$result = db_query("SELECT n.nid FROM {node} n WHERE n.type = 'show'");

$rowcount = 0; 
$modcount = 0;


while ($row = db_fetch_object($result)) {

  $processed_flag = false;
  $rowcount++;
//  if($row->nid != 8460) continue;
//  if($row->nid != 9401 && $row->nid != 3238) continue;
  if($row->nid < 10077) continue; /* not done yet */


  $node = node_load($row->nid, NULL, TRUE);

### THIS SHOULD BE <br/>s and shit
#  if(preg_match("/^(<br.*>)*/Us", $node->body, $match)) { 
  print " :: $node->nid :: $node->title ::  $match[0]" ; 
print "\n";
    $processed_flag = true;
    $modcount++;
  }


#  if($processed_flag) { $node->teaser = node_teaser($node->body, $node->format); node_save($node); }

}

print "rows = $rowcount<br/>\n";
print "modified rows = $modcount<br/>\n";

?>
</body>
</html>
