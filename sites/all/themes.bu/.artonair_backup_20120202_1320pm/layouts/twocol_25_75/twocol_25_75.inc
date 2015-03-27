<?php
// $Id: twocol.inc,v 1.1.2.2 2010/01/13 06:25:15 merlinofchaos Exp $

// Plugin definition
$plugin = array(
  'title' => t('Two column, 25% 75%'),
  'icon' => 'twocol_25_75.png',
  'theme' => 'twocol_25_75',
  'css' => 'twocol_25_75.css',
  'panels' => array(
    'left' => t('Left side'),
    'right' => t('Right side')
  ),
);
