<html> 
<body> 
<h1>ALL OF THESE PAGES ARE UNDATED! OH NOOOOO </h1> 
<?php

//* this is for mass editing nodes. only touch if you know what you'er doing */

error_reporting(E_ALL);
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$result = db_query("SELECT n.nid FROM {node} n WHERE n.type = 'show'");

$rowcount = 0; $broadcastcount = 0; $m3ucount = 0; $legdated = 0;


while ($row = db_fetch_object($result)) {
  $processed_flag = false;
  $rowcount++;
//  if($row->nid != 8460) continue;
//  if($row->nid != 9401 && $row->nid != 3238) continue;


  $node = node_load($row->nid, NULL, TRUE);

if($node->status != 1) continue;
  # useful if you don't know $node like the back of your hand
//  print "<pre>";
//print $node->body;
//  print htmlspecialchars($node->body, ENT_QUOTES);
//  print htmlspecialchars(print_r($node, TRUE), ENT_QUOTES);
//  print "</pre>";

//if(preg_match("/First broadcast(.*\d{4})/U", $node->body, $match)) { $broadcastcount++; print_r($match); print preg_replace('/' . $match[0] . '/', '', $node->body); }
//if(preg_match("/First broadcast(.*\d{4})/U", $node->body, $match)) { 

//  $broadcastcount++; 
  if(!($node->field_aired_date[0]['value'])) { 
//    print_r($node->field_aired_date); 
//  }
//print $rowcount . " :: " . 
print "(" . l("edit", "node/" . $row->nid . "/edit", array('absolute' => true)) . ")  ---- " . l("$node->title", "node/" . $row->nid, array('absolute' => true)) . "<br />\n"; 

//print_r($node);
//if($node->uid != 14) {
//  $processed_flag = true;
//  $node->uid = 14;
//    if($node->field_admin_legacy_status[0]['value'] == "dated") {
//  if($node->field_aired_date[0]['value']) { $drupdated++; print "D"; }
//if(preg_match("/First broadcast(.*\d{4})/U", $node->body, $match)) { 
//if(preg_match("/First broadcast.*([a-zA-Z]+ [0-9]+, 20[0-9]{2})/U", $node->body, $match)) { 
//if(!($node->field_audio_path[0]['value']))
//if(preg_match("/gapro-1/U", $node->body, $match)) { 
//if(preg_match("/<script type=.*swfobject.*flashplayer.*<\/script>/Us", $node->body, $match)) { 
//if(preg_match("/(<a href=.*\.m3u.*>.*listen.*<\/a>.*ram.*RealPlayer<\/a>)/Us", $node->body, $match)) { 
//if(preg_match("/<a href=.*\.m3u.*>.*listen.*<\/a>.*|.*<a href=.*sb.*ram.*RealPlayer.*<\/a>/Us", $node->body, $match)) { 
//if(preg_match_all("/m3u\/(sb.*m3u)\"/Us", $node->body, $match)) {
//print_r($node);
//if(preg_match("/\/(sb.*\.ram)/U", $node->body, $match)) { 
//if(preg_match("/^(\s*<br \/>\s*)+/Us", $node->body, $match)) { 
//  if(!($node->field_aired_date[0]['value'])) { 
//if(count($node->field_audio_path) > 1) {
//if(preg_match("/<a href=.*popup.*<\/a>/Us", $node->body, $match)) { 
//if(preg_match("/christoph/iUs", $node->body, $match))  
//if(preg_match("/german/iUs", $node->body, $match)) { 

//  $node->field_audio_path[0]['value'] = preg_replace("/m3u/", "mp3", $match[1]);
//      $processed_flag = true;
//preg_match("/sb.*m3u/Us", $node->body, $match);
//  $node->field_audio_path[0]['value'] = 
//:print " USER CHANGED";
//print $node->body;
//print "orig \n\n\n";
//$node->teaser = $node->body;
//$node->body = preg_replace("/^(\s*<br\s?\/>\s*)+/s", "", $node->body) ;
//$node->body = preg_replace("/<a href=.*\.m3u.*>.*listen.*<\/a>.*|.*<a href=.*sb.*ram.*RealPlayer.*<\/a>/Us", "", $node->body) ;
//$node->body = preg_replace("/^(\s*<br\s?\/>\s*)+/s", "", $node->body) ;
//$node->body = preg_replace("/<a href=.*\.m3u.*>.*listen.*<\/a>.*|.*<a href=.*sb.*ram.*RealPlayer.*<\/a>(\s*<br\s?\/>\s*)*/Us", "", $node->body) ;
//$node->body = preg_replace("/<a href=.*popup_link.*artonair_music_popup.*Listen\s*<\/a>/Us", "", $node->body);
//$node->body = preg_replace("/^(\s*<br\s?\/>\s*)+/s", "", $node->body) ;

//print $node->body;
//$node->teaser = $node->body;
//      $processed_flag = true;
//print_r($match);
$textmatch++;
//$fieldcount = 0;
//foreach($match[1] as $m3uname) {
//$node->field_audio_path[$fieldcount++]['value'] = preg_replace("/m3u/", "mp3", $m3uname);
}
//  <a href="http://artonair.org/web/archive/metafiles/m3u/sbtmtyes_14yesyesyall_rammellzee.m3u"> listen</a> |  
//<a href="http://artonair.org/web/archive/metafiles/ram/sbtmtyes_14yesyesyall_rammellzee.ram"> listen with RealPlayer</a> 
//$node->field_legacy_body[0]['value'] = $node->body;
//print $node->body;
//$node->body = preg_replace("/(<a href=.*\.m3u.*>.*listen.*<\/a>.*ram.*RealPlayer<\/a>)/Us", "", $node->body) ;
//
//$node->body = preg_replace("/<a href=.*\.m3u.*>.*listen.*<\/a>.*|.*<a href=.*sb.*ram.*RealPlayer.*<\/a>/Us", "", $node->body);
//$node->body = preg_replace("/<small>.*First broadcast.*small>/U", "", $node->body);
//$node->body = preg_replace("/<\!--break-->/", "", $node->body);
//print "M ";

//}

//  print $node->field_audio_path[0]['value'];
//print $node->body;
//  $node->field_aired_date[0]['value'] = date('Y-m-dT00:00:00', strtotime(trim($match[1])));
//print strtotime(trim($match[1]));
//  $node->field_legacy_audio_path[0]['value'] = "yes_via_script";
//  $node->field_legacy_status_dated[0]['value'] = "yes_via_script";
//  $node->field_legacy_status_dated[0]['value'] = "no";

//  $node->field_legacy_status_dated[0]['value'] = "";
//  if($node->field_legacy_status_dated[0]['value']) { // == "pulledfromfirstbroadcast") {

//    print $node->field_admin_legacy_status[0]['value'];
//    $node->field_aired_date[0]['value'] = 
//    $node->field_aired_date[0]['value'] = date('Y-m-dT00:00:00', strtotime(trim($match[1])));
//      $legdated++;
//  print $node->field_legacy_status_dated[0]['value'];
//    print $node->field_admin_legacy_status[0]['value'];
//      print $node->body;
//    print $node->body;



//print "\n\n\n";  $node->body = preg_replace('/(First broadcast.*\d{4})/U', '<!-- legacy date --  ${1} -->', $node->body);
//print $node->body;
//  $node->field_admin_legacy_status = "dated";
//}

//if($node->field_aired_date[0]['value']) { print_r($node->field_aired_date); }

//if(preg_match("/First broadcast/", preg_replace('/\s+/', '', $node->body))) { $broadcastcount++; }
//else { print $node->body; }
//if(preg_match("/sb.*\.m3u/", $node->body) || preg_match("/sb.*\.ram/", $node->body)) { $m3ucount++; print "yay"; }
//else { print $node->body; }

  # somewhat useless example edit
//  $name = strtolower($node->field_name[0]['value']);
//  $node->field_name[0]['value'] = $name;

if($processed_flag) node_save($node);


//if($broadcastcount % 100 == 0) print "B" . $broadcastcount;
//if($rowcount % 100 == 0) print $rowcount;
//if($legdated % 100 == 0) print "D" .$rowcount;

}

print "$textmatch shows are undated! (out of a total of $rowcount shows)<br/>\n";


?>
</body>
</html>
