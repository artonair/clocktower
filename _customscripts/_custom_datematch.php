<html> 
<body> 
<h1>ALL OF THESE PAGES ARE UNDATED! OH NOOOOO </h1> 
<?php

//* this is for mass editing nodes. only touch if you know what you'er doing */

$csvfile = fopen("airmaster.csv", "r");
$allcsv = array();

while (($data = fgetcsv($csvfile, 0, "^")) !== FALSE) {
      $num = count($data);
        $row++;
#        echo "<p> $num fields in line $row: <br /></p>\n";
#        for ($c=0; $c < $num; $c++) {
#            echo $data[$c] . "<br />\n";
	    array_push($allcsv, array("title" => $data[0], "date" => $data[10]));
	    print "HEYYYYY" . $data[0] . "fds\n";
#        }
	
}
fclose($handle);

foreach($allcsv as $row) {
  if(preg_match("/^\d*\/\d*\/\d*\s*$/", $row['date'] ) == 0)
    print_r($row); 
}

require_once './includes/bootstrap.inc';
require_once './includes/common.inc';
require_once './includes/module.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
drupal_load('module', 'i18n'); // I had to load i18n, otherwise I got some errors. If you don't use it, remove this
module_invoke('i18n', 'boot');
drupal_load('module', 'node');
module_invoke('node', 'boot');


$result = db_query("SELECT nid FROM {node}  WHERE type = 'show';");

$rowcount = 0; $broadcastcount = 0; $m3ucount = 0; $legdated = 0;


while ($row = db_fetch_object($result)) {
  $processed_flag = false;
  $rowcount++;
//  if($row->nid != 8460) continue;
//  if($row->nid != 9401 && $row->nid != 3238) continue;

  print $row->nid;

  $node = node_load($row->nid, NULL, TRUE);
  node_view($node);

  if(!($node->field_aired_date[0]['value'])) { 
    print " :: $row->nid";
    print "\n";
  } 

//if($processed_flag) node_save($node);


//if($broadcastcount % 100 == 0) print "B" . $broadcastcount;
//if($rowcount % 100 == 0) print $rowcount;
//if($legdated % 100 == 0) print "D" .$rowcount;

}

print "rows = $rowcount<br/>\n";
print "legdateds = $legdated<br/>\n";
print "drupdateds = $drupdated<br/>\n";
print "(dated)date in text = $textmatch<br/>\n";
print " those should eequal each other";
print "broadcast = $broadcastcount<br/>\n";
print "m3u = $m3ucount<br/>\n";
print "UNDATED = $undated<br/>\n";


?>
</body>
</html>
