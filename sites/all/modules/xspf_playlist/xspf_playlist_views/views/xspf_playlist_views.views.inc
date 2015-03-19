<?php

/**
 * @file
 * Provides XSPF playlist support for the Views module.
 */

/**
 * Implementation of hook_views_plugins
 */
function xspf_playlist_views_views_plugins() {
  $path = drupal_get_path('module', 'xspf_playlist_views');
  return array(
    'module' => 'xspf_playlist_views',
    'style' => array(
      'xspf_playlist' => array(
        'title' => t('XSPF Playlist'),
        'help' => t('Generates an XSPF playlist from a view.'),
        'path' => "$path/views",
        'handler' => 'xspf_playlist_views_plugin_style_xspf',
        'uses row plugin' => FALSE,
        'uses fields' => TRUE,
        'uses options' => TRUE,
        'type' => 'feed',
      ),
    ),
  );
}