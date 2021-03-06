<?php
/**
 * @file nodereference_explorer_plugin_content_link.inc
 * Nodereference Explorer plugins care about the different handling of CCK field types.
 * They provide a bunch of object methods which hook into the rendering process of
 * the widget.
 */

module_load_include('inc', NODE_REFERENCE_EXPLORER_MODULE_NAME, 'plugins/content/nodereference_explorer_plugin_content');

class nodereference_explorer_plugin_content_link extends nodereference_explorer_plugin_content {

  public function __construct() {}

  /**
   * The parent widget to which actions and preview is assigned, e. g. autocomplete widget.
   * @param $element
   * @param $edit
   * @param $form_state
   * @param $form
   * @return
   *   array form element
   */
  public function widget_process($element, $edit, $form_state, $form) {
    $element = parent::widget_process($element, $edit, $form_state, $form); // sanitize widget values
    $element = link_process($element, $edit, $form_state, $form); // process parent widget
    
    if (!$element['#default_value']['url']) {
      $element['#default_value']['value'] = '';
    }
    
    // Identify internal node links
    if ($element['#default_value']['value']) { // in NR autocomplete format, e. g. test [nid: 222]
      nodereference_explorer_include('nodereference_explorer.util');
      $value = nodereference_explorer_util_parse_widget_value($element['#default_value']['value']);
      $node = node_load($value['nid']);
    }
    elseif ($element['#default_value']['url']) { // get node by path alias
      $path = drupal_get_normal_path($element['#default_value']['url']); 
      list (, $nid) = preg_split('/\//', $path);
      $node = node_load($nid);
    }
    // internal value for JS actions
    $element['value'] = array(
      '#id' => $element['#id'],
      '#type' => 'hidden',
      // set possibly overriden title and node id if existing
      '#value' => !empty($element['#default_value']['title']) && !empty($node->nid) ? $element['#default_value']['title'] . ' [nid: ' . $node->nid .']': '',
    );
    
    // set nid attribute used by widget preview
    if ($node->nid) {
      $element['#default_value']['nid'] = $node->nid;
    }    
    
    //create an error element, needed for storing field name for widget settings form and
    //validates widget settings properly
    $field_key  = $element['#columns'][0];
    $element['_error_element'] = array(
      '#type' => 'value',
      // Wrapping the element around a text_textfield element creates aS
      // nested element, so the final id will look like 'field-name-0-url'.
      '#value' => implode('][', array_merge($element['#parents'], array($field_key))),
    );
    return $element;
  }

  /**
   * Extended rendering function for parent widget.
   * @param $element
   */
  public function theme_nodereference_explorer($element) {
    $output .= theme('link', $element);
    $output .= $element['actions']['#children'];
    $output .= theme('hidden', $element['value']);
    $output .= theme('markup', $element['preview']);
    return $output;
  }

  /**
   * Additional widget settings form elements.
   * @param $widget
   */
  public function widget_settings_form($widget) {
    $form = nodereference_field_settings('form', $widget);
    $form['referenceable_types']['#weight'] = '1';
    $form['advanced']['#weight'] = '2';
    return $form;
  }

  /**
   * Additional widget settings validation.
   * @param $widget
   */
  public function widget_settings_validate($widget) {
    nodereference_field_settings('validate', $widget);
  }

   /**
   * Additional widget settings save fields.
   * @param $widget
   */
  public function widget_settings_save($widget) {
    return nodereference_field_settings('save', $widget);
  }
}
