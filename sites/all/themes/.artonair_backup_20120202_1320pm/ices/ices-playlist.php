#!/usr/local/bin/php
<?php
    // variables
    $ices_wrapper_location = "/usr/local/etc/ices-wrapper.sh";
    $ices_playlist_location = "/web/staging.artonair.org/htdocs/sites/all/themes/artonair/ices";
    $ices_md5_filename = "ices-playlist.md5sum";
    $ices_playlist_filename = "ices-playlist.txt";

    // computed paths
    $ices_playlist_filepath = $ices_playlist_location . "/" .$ices_playlist_filename;
    $ices_md5_filepath = $ices_playlist_location . "/" . $ices_md5_filename;
  
    ini_set('memory_limit', '96M');

  
    // Site specific variables
    $username = "artonair";
    $drupal_base_path = "/web/staging.artonair.org/htdocs/";
    $drupal_base_url = parse_url('http://staging.artonair.org');
  
    $_SERVER['HTTP_HOST'] = $drupal_base_url['host'];
    $_SERVER['PHP_SELF'] = $drupal_base_url['path'].'/index.php';
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] = $_SERVER['PHP_SELF'];
    $_SERVER['REMOTE_ADDR'] = NULL;
    $_SERVER['REQUEST_METHOD'] = NULL;
  
    chdir($drupal_base_path);
  
    require_once "includes/bootstrap.inc";
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
  
    // get view output. just to remind you, airstream_latest_ices_output gets the current airstream and lists its files in order.
    $view_output = views_embed_view("airstream_latest_ices_output", "feed_1"); 

    $FILEipl = fopen($ices_playlist_filepath, 'w') or die("can't open file");
    fwrite($FILEipl, $view_output);
    fclose($FILEipl);

    $old_md5sum = `cat $ices_md5_filepath`;
    `md5 -q $ices_playlist_filepath > $ices_md5_filepath`;
    $new_md5sum = `md5 -q $ices_playlist_filepath`;

    if($new_md5sum == $old_md5sum) print "ALL SYSTEMS AS USUAL\n";
    else { print "OUCH PLAYLIST DIFFERENT -- RESTARTING ICES\n"; `$ices_wrapper_location reload`; }
    //
    //
?>
