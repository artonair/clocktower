<html>
<body>
<?php

/*

what the csv columns mean
0 contentid
  1 title
  2 title_alias
  3 introtext
  4 fulltext
  5 state
  6 sectionid
  7 mask
  8 catid
  9 created
 10 created_by
 11 created_by_alias
 12 modified
 13 modified_by
 14 checked_out
 15 checked_out_time
 16 publish_up
 17 publish_down
 18 images
 19 urls
 20 attribs
 21 version
 22 parentid
 23 ordering
 24 metakey
 25 metadesc
 26 access
 27 hits
*/

//* this is for mass editing nodes. only touch if you know what you'er doing */


chdir('../');

error_reporting(E_ALL);
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);



$row = 0;
if (($handle = fopen("_customscripts/joomlaexport.csv", "r")) != FALSE) {
    while (!feof($handle)) {
    $row++;
    $line = stream_get_line($handle, 100000, "|***|");

    $data = preg_split("/\|\*\|/", $line); 

  print "======================\n\n";
print "a";
	if($row >= 0)	 {
print "b";
	    $node = new stdClass();
	    $node->uid = 14; //user = airjoomla
	    $node->title = $data[1];
	    $node->body = $data[3];
print "c";
	    $node->type = 'show';
	    if($data[12] != "0000-00-00 00:00:00") { $node->modified = $data[12]; }
	    $node->status = $data[5];         
	    $node->field_joomlaid[0]['value'] = $data[0] . "|" . $data[6] . "|" . $data[8];
print "d";
	    $node->field_aired_date[0]['value']  = $data[9];
	    $node->field_legacy_body[0]['value'] = $data[3];
	    $node->created = $data[9];
print "presubmit";
	    node_submit($node);
	    node_validate($node);
	   print_r($node);
print "presave";
	    node_save($node);
print "postsave";

$createddate = date("Y-m-d H:i:s", strtotime($data[9]));

print "INSERT INTO {joomladrupal_correlation_mostnodes} (joomlaid, drupalid, created) VALUES (" . $data[0] . "," . $node->nid . "," . date("Y-m-d H:i:s", strtotime($data[9])) . ");";
db_query("INSERT INTO {joomladrupal_correlation_mostnodes} (joomlaid, drupalid, created) VALUES (" . $data[0] . "," . $node->nid . ",'" . $createddate . "');");
print ":::::"; print_r($result); print ":::::";

	    print "title = " . $node->title . "\n";
	    print "row = $row\n";
  print "\n\n======================\n";
	}

    }
    fclose($handle);
}

print "\n\ntotal rows = $row\n";

?>
</body>
</html>
