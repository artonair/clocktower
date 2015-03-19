<?php include_once('sites/all/themes/artonair/custom_functions/string_truncate.php');  /* function for truncating strings */ 
if($node->field_summary[0]['safe']) {
  print $node->field_summary[0]['safe']; 
} else {
  print stringTruncate($node->body, 400, " ", "..."); 
} ?>

