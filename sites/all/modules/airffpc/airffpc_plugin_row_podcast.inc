<?php /*THIS IS THE ONLY FILE THAT WAS MODIFIED */
class airffpc_plugin_row_podcast extends views_plugin_row_node_rss {

  function render($row) {

  include("sites/all/themes/artonair/custom_functions/custom_variable.php"); //DTLADD

    // For the most part, this code is taken from node_feed() in node.module
    global $base_url;

    $item_length = $this->options['item_length'];
    if ($item_length == 'default') {
      $item_length = variable_get('feed_item_length', 'teaser');
    }

    if (empty($this->view->style_plugin->namespaces)) {
      $this->view->style_plugin->namespaces['xmlns:itunes'] = 'http://www.itunes.com/dtds/podcast-1.0.dtd';
    }

    // Load the specified node:
    $item = node_load($row->nid);
    $item->build_mode = NODE_BUILD_RSS;

    $item->link = $base_url; //DTLADD
    // $item->link = url("node/$row->nid", array('absolute' => TRUE)); //DTLEDIT

    if ($item_length != 'title') {
      $teaser = ($item_length == 'teaser') ? TRUE : FALSE;

      // Filter and prepare node teaser
      if (node_hook($item, 'view')) {
        $item = node_invoke($item, 'view', $teaser, FALSE);
      }
      else {
        $item = node_prepare($item, $teaser);
      }

      // Allow modules to change $node->teaser before viewing.
      node_invoke_nodeapi($item, 'view', $teaser, FALSE);
    }


    // Allow modules to add additional item fields and/or modify $item
    $extra = node_invoke_nodeapi($item, 'rss item');

    $sqid = 4; /* this is the subqueue for podccasts; hardcoded in. */ //DTL ADD
    $pubDateuse = db_result(db_query("SELECT timestamp FROM {nodequeue_nodes} WHERE sqid = %d AND nid = %d", $sqid, $item->nid)); //DTLADD
    if(!$pubDateuse) $pubDateuse = strtotime($item->field_aired_date[0]['value']); //DTLADD


    $extra = array_merge($extra,
      array(
        //array('key' => 'pubDate', 'value' => gmdate('r', $item->created)),
//      else $pubDateuse = $item->field_aired_date[0]['timestamp'];
        array('key' => 'pubDate', 'value' => gmdate('r', $pubDateuse)), //DTLEDIT - done by when the node is added to the nodequeue.
        // The author should be an email address. Need to add this in.
        //array('key' => 'author', 'value' => $item->name),
      )
    );
    foreach ($extra as $element) {
      if (isset($element['namespace'])) {
        $this->view->style_plugin->namespaces = array_merge($this->view->style_plugin->namespaces, $element['namespace']);
      }
    }
    // Prepare the item description
    switch ($item_length) {
      case 'fulltext':
        $item_text = $item->body;
        break;
      case 'teaser':
        $item_text = $item->teaser;
        if (!empty($item->readmore)) {
          $item_text .= '<p>' . l(t('read more'), 'node/' . $item->nid, array('absolute' => TRUE, 'attributes' => array('target' => '_blank'))) . '</p>';
        }
        break;
      case 'title':
        $item_text = $item->title; //DTLEDIT
        break;
    }

    $stripped_item_text = strip_tags($item_text);

    if (strlen($stripped_item_text) > 255) {
      $item_subtitle = substr($stripped_item_text, 0, 252) .'...';
    }
    else {
      $item_subtitle = $stripped_item_text;
    }

    if (!getid3_load(TRUE)) {
      return NULL;
    }
    $getid3 = new getID3;
    foreach ( $this->view->field as $id => $field ) { // if ($field->content_field['widget']['type'] == 'filefield_widget') { DTLEDIT
      if ($field->content_field['field_name'] == 'field_audio_path') { //DTLEDIT
        foreach ( $item->{$field->content_field['field_name']} as $file ) {
	  $file_filepath = $air_mp3s_path . "/" . $file['value']; //DTLADD
	  $file_fileurl = $air_mp3s_url . "/" . $file['value']; //DTLADD
          $info = $getid3->analyze($file_filepath); //DTLEDIT
          $file_extra = array();
          $file_extra[] = array(
            'key' => 'enclosure',
            'attributes'  =>  array(
              'url' => url($file_fileurl, array('absolute' => 'true')), //DTLEDIT
              'length' => (int) $info['playtime_seconds'],
              'type' => $info['mime_type'], //DTLEDIT
            ),
          );
          $file_extra[] = array(
            'key' => 'itunes:duration',
            'value' => $info['playtime_string'],
          );
          /*$file_extra[] = array(
            'key' => 'itunes:author',
            //'value' => $info['tags']['id3v2']['artist'][0],
          ); DTLEDIT */
          /* $file_extra[] = array(
            'key' => 'itunes:subtitle',
            'value' => str_replace('&amp;', '&', $item_subtitle),
          ); DTLEDIT */
          $file_extra[] = array(
            'key' => 'itunes:summary',
            'value' => str_replace('&amp;', '&', $item->teaser), //DTLEDIT
          );
          $file_extra[] = array(
            'key' => 'guid',
            'value' => url($file_fileurl, array('absolute' => 'true')), //DTLEDIT
            'attributes' => array('isPermaLink' => 'false'),
          );
          $file_extra = array_merge($extra, $file_extra);
          /*
           * The following function takes title, link, description and then
           * all additional XML elements.  For the title we'll use the node
           * title.  Link serves no real purpose in a podcast.  Description
           * is overridden by the extra "subtitle" tag but we'll keep it for
           * completeness with RSS and use the node teaser.
          */
          $output .= format_rss_item($item->title, $item->link, $item_text, $file_extra );
        }
      }
    }
    return $output;
  }
}
