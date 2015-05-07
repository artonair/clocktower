<?php

/*
 * Much of the output here is based on the Apple Podcast standard.  Details
 * can be found here:
 * http://www.apple.com/itunes/store/podcaststechspecs.html
 *
 * Note: We need a custom style plugin because the default RSS plugin does
 * not permit additional elements to be added to the feed.
*/

function airffpc_views_plugins() {
  return array(
    'module' => 'airffpc',
    'style'   => array(
      'airffpc podcast' => array(
        'title' => t('AIRFFPC Podcast Feed'),
        'help' => t('Generates Podcast Feed from a view.'),
        'handler' => 'airffpc_plugin_style_podcast',
        'theme' => 'airffpc_view_podcast_feed',
        'uses row plugin' => TRUE,
        'uses options' => TRUE,
        'type' => 'feed',
        'parent' => 'rss',
      ),
    ),
    'row'   => array(
      'airffpc podcast' => array(
        'title' => t('AIRFFPC Podcast Episode'),
        'help' => t('Display the node as a Podcast Episode.'),
        'handler' => 'airffpc_plugin_row_podcast',
        'uses fields' => TRUE,
        'type' => 'feed',
        'parent' => 'node_rss',
        'uses options' => TRUE,
      ),
    ),
  );
}
