<?php

/**
 * @file
 * XSPF playlist style plugin.
 */


/**
 * Default style plugin to render an XSPF playlist.
 *
 * @ingroup views_style_plugins
 */
class xspf_playlist_views_plugin_style_xspf extends views_plugin_style {

  function attach_to($display_id, $path, $title) {
    $display = $this->view->display[$display_id]->handler;
    $url_options = array();
    $input = $this->view->get_exposed_input();
    if ($input) {
      $url_options['query'] = $input;
    }

    $url = url($this->view->get_url(NULL, $path), $url_options);
    if ($display->has_path()) {
      if (empty($this->preview)) {
        drupal_add_feed($url, $title);
      }
    }
    else {
      if (empty($this->view->feed_icon)) {
        $this->view->feed_icon = '';
      }

      $this->view->feed_icon .= theme('feed_icon', $url, $title);
      drupal_add_link(array(
        'rel' => 'alternate',
        'type' => 'application/xspf+xml',
        'title' => $title,
        'href' => $url
      ));
    }
  }

  /**
   * Set options fields and default values.
   *
   * @return
   * An array of options information.
   */
  function option_definition() {
    $options = parent::option_definition();
    $options['description'] = array(
      'default' => 'XSPF Playlist',
      'translatable' => FALSE,
    );
    $options['annotation'] = array(
      'default' => '',
      'translatable' => TRUE
    );
    return $options;
  }


  function options_form(&$form, &$form_state) {
    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Playlist description'),
      '#default_value' => $this->options['description'],
      '#description' => t('Describe your playlist here'),
    );

    $form['annotation'] = array(
      '#type' => 'textfield',
      '#title' => t('Annotation'),
      '#default_value' => $this->options['annotation'],
      '#description' => t('This will appear in the XSPF feed itself.'),
    );
  }

  /**
   * Create the preview display
   * @TODO force this to use XSPF display
   * @return string
   */
  function preview() {
    return "<pre>". print_r($this->view->result, true) .'</pre>';
  }

  function render() {
    // We need to get the current view so that we can find the field labels.
    $current_view = $this->view->current_display;
    $actual_fields = array();
    // Get all the fields for this view.
    if ($fields = $this->view->display[$current_view]->handler->handlers['field'] ) {
      // We have to remap the fields so that it is easy to remap for xml keys.
      foreach ($fields as $name => $field) {
        $actual_fields[$name] = $field->options;
      }
    }

    // make sure we have results
    if ($this->view->result) {
      $this->render_fields($this->view->result);
      $items = array();
      foreach ($this->rendered_fields as $row) {
        if ($item = xspf_playlist_views_build_item($row, $actual_fields)) {
          $items[] = $item;
        }
      }

      // If there are no items, exit
      if (! $items) {
        // return;
      }

      // build the playlist
      $playlist = array(
        'title' => check_plain($this->view->name),
        'items' => $items,
      );

      // Do we have annotation?
      $this->options['annotation'] ? $playlist['annotation'] = $this->options['annotation'] : null;
      // Do we have a description?
      $this->options['description'] ? $playlist['info'] = $this->options['description'] : null;

      // if we are in preview mode, just return the XML
      if ($this->view->live_preview) {
        return "<pre>" . check_plain(xspf_playlist_list($playlist)) .'</pre>';
      }

      // render the playlist
      xspf_playlist_render($playlist);
      exit();
    }
  }


}
