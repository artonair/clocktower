#!/usr/bin/php -q
<?php
 
// set some server variables so Drupal doesn't freak out
$_SERVER['SCRIPT_NAME'] = '/_custom_datematch2.php';
$_SERVER['SCRIPT_FILENAME'] = '/_custom_datematch.php';
$_SERVER['HTTP_HOST'] = 'staging.artonair.org';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['REQUEST_METHOD'] = 'POST';
 
// act as the first user
global $user;
$user->uid = 1;
 
// change to the Drupal directory
chdir('/web/staging.artonair.org/htdocs/drupal');
 
// Drupal bootstrap throws some errors when run via command line
//  so we tone down error reporting temporarily
error_reporting(E_ERROR | E_PARSE);
 
// run the initial Drupal bootstrap process
require_once('includes/bootstrap.inc');
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


print "hello";
 
// restore error reporting to its normal setting
error_reporting(E_ALL);


