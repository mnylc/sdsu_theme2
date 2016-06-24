<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

/**
 * Implements hook_form_alter().
 */
function ir7_saas_form_islandora_solr_simple_search_form_alter(&$form, &$form_state, $form_id) {
  $link = array(
    '#markup' => l(t("Advanced Search"), "advanced-search", array('attributes' => array('class' => array('adv-search')))),
  );
  $form['simple']['advanced_link'] = $link;
  $form['simple']['islandora_simple_search_query']['#attributes']['placeholder'] = t("Search Repository");
  $form['simple']['islandora_simple_search_query']['#title_display'] = 'invisible';
}

function ir7_saas_css_alter(&$css) {
  $exclude = array(
    'sites/all/modules/islandora_solution_pack_collection/css/islandora_basic_collection.base.css' => FALSE,
    'sites/all/modules/islandora_solution_pack_collection/css/islandora_basic_collection.theme.css ' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}
