<html> 
<body> 
<?php

$multiple = array();

$loghandle = fopen("./_custom_mysql_script.log", "a+");

//kifwrite($loghandle, "\nscript running on 0

//* this is for mass editing nodes. only touch if you know what you'er doing */

fwrite($loghandle, "\n====================\n");
fwrite($loghandle, "datafile for script run on " . date("U // F j, Y, h:i:s A") . "\n");
fwrite($loghandle, "====================\n");
fwrite($loghandle, "joomlaid, createdtime, drupal_nid\n");


require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$joomladbhost = 'localhost';
$joomladbuser = 'geops1';
$joomladbpass = 'psid4n';
$joomladbname = 'artonair_joomla';
$joomlaconn = mysql_connect($joomladbhost, $joomladbuser, $joomladbpass, TRUE) or die('Error connecting to mysql');
mysql_select_db($joomladbname);
//$result = mysql_query("SELECT created FROM wps1_newsite_content WHERE id = $joomlaid"); 
//$joomlaresult = mysql_query("SELECT id, created FROM wps1_newsite_content LIMIT 10");
$joomlaresult = mysql_query("SELECT id, created FROM wps1_newsite_content");
while($joomlarow = mysql_fetch_array($joomlaresult)) {


	$joomlacreated = $joomlarow['created'];
	$joomlaid = $joomlarow['id'];

	$joomlacreated_time = strtotime($joomlacreated);



	$drupalresult = db_query("SELECT n.nid FROM {node} n WHERE n.created = %d", $joomlacreated_time);
	$nodeids = array();
	$drupalrowcount = 0;
	while ($drupalrow = db_fetch_object($drupalresult)) {
	  $drupalrowcount++;
	  array_push($nodeids, $drupalrow->nid);
	}


	$nidcount++;

	if($drupalrowcount > 1) {
	print "joomla id = $joomlaid ====>>>>";
	  print "MULTIPLE!! " . implode(" :: ", $nodeids);
	  $multiple[implode(" :: ", $nodeids)] .= "${joomlaid}:" ;
	print "\n";
	  fwrite($loghandle, $joomlaid . "," . $joomlacreated_time . "," . implode("::",$nodeids));
	} else {
	  fwrite($loghandle, $joomlaid . "," . $joomlacreated_time . "," . $nodeids[0]);
//	print "joomla id = $joomlaid ====>>>>";
//	  print $nodeids[0];

	  //db_query("INSERT INTO {joomla_drupal_corr} (joomlaid, drupalid, created) VALUES (%d, %d, '%s')", $joomlaid, $nodeids[0], date("Y-m-d G:i:s", $joomlacreated_time)); 
	  //db_query("INSERT INTO {joomla_drupal_corr} (joomlaid, drupalid, created) VALUES (%d, %d, '%s')", $joomlaid, $nodeids[0], "2007052309152");
	  //db_query("INSERT INTO {joomla_drupal_corr} (joomlaid, drupalid, created) VALUES (%d, %d, %s)", $joomlaid, $nodeids[0], "644");


	}

	fwrite($loghandle, "\n");


} /* this is the end of one contentid */

mysql_close($joomlaconn);

print "nids processed = $nidcount<br/>\n";
fwrite($loghandle, "nids processed = $nidcount\n");

fclose($loghandle);

print_r($multiple);

?>
</body>
</html>
