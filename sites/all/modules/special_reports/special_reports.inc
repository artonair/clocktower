<?php

// $Id$ activated_modules.module,v 1 2010/07/01 11:10:07 egerm Exp $



/**

* @file

* External functions used in various Special Reports

*

*/



  /**

  * Checks active status (Active:1, In-Active:0)

  * @param  = value  : a number of representing the active status

  * @return        : a string with the active/in-active or error status

  *

  */

  function special_reports_status($value) {

  if ($value == 1)

    return ("Active");

  elseif ($value == 0)

    return ("In-active");

  else

    return ("Warning! Warning!! Warning Will Robinson! Error with the status.");

  }



  /**

  * Do zebra striping for cleaner results

  * @param    = has_children    : 

  * @param    = in_active_trail  : 

  * @return                    : returns an even/odd class for stripping

  *

  * Thanks to dmitrig01 May 8, 2008 - 04:47

  *   http://drupal.org/node/249598
  *

  */

  function special_reports_zebra($has_children = FALSE, $in_active_trail = FALSE) {

  static $zebra = FALSE;

  $zebra = !$zebra;



  if ($in_active_trail) {

    $class .= ' active-trail';

  }

  if ($zebra) {

    $class .= ' even';

  }

  else {

    $class .= ' odd';

  }

  return ($class);

  }





  /**

  * Check length of value; if too large/long, then display in textarea

  * @param    : string value being checked

  * @return  : the value, possibly wrapped in a textarea

  *

  */

  function special_reports_length($something) {

  $lines = count(explode("\n", $something));

  $length = drupal_strlen($something);

  if (($length > 34) || ($lines > 1)) {

    if ($lines > 10) {

      $lines = 10;

    }

    $something = '<textarea cols="64" rows="'. ($lines + 1) .'">'. $something .'</textarea>';

  } 

  return ($something);

  }
