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
function sdsu_theme_form_islandora_solr_simple_search_form_alter(&$form, &$form_state, $form_id) {
  $link = array(
    '#markup' => l(t("Advanced Search"), "advanced-search", array('attributes' => array('class' => array('adv-search')))),
  );
  $form['simple']['advanced_link'] = $link;
  $form['simple']['islandora_simple_search_query']['#attributes']['placeholder'] = t("Search SDSU Repository");
  if (drupal_is_front_page()) {
    $form['simple']['islandora_simple_search_query']['#attributes']['size'] = 30;
  }
  else {
    $form['simple']['islandora_simple_search_query']['#title_display'] = 'invisible';
    $form['simple']['islandora_simple_search_query']['#attributes']['size'] = 28;
  }

  $form['simple']['islandora_simple_search_query']['#title_display'] = 'invisible';
}

/**
 * Implements hook_preprocess().
 */
function sdsu_theme_preprocess_islandora_solr_wrapper(&$variables) {
  $string_count = str_replace(array('(', ')'), array("", ""), $variables['islandora_solr_result_count']);
  $variables['islandora_solr_result_count'] = "<div class='solr-result-label-count'>" . "<div>" . t("Search Results ") . $string_count . "</div></div>";

  module_load_include('inc', 'islandora_solr', 'includes/blocks');
  $variables['solr_current_query'] = sdsu_theme_block_render('islandora_solr', 'current_query');
  $replace_minus = str_replace(array('(-)'), array("<span class='remove-fct-x'>X</span>"), $variables['solr_current_query']);
  $variables['solr_current_query'] = $replace_minus;
  $variables['solr_sort'] = sdsu_theme_block_render('islandora_solr', 'sort');
  global $_islandora_solr_queryclass;
  $variables['your_search'] = "<h1 class='search-main-title'>" . t("You Searched ") . '"' . $_islandora_solr_queryclass->solrQuery . '"' . "</h1>";
}

function sdsu_theme_islandora_solr_facet_bucket_classes_alter(&$buckets, &$query_processor) {
//   dsm($buckets, "query_processor");islandora_paged_content_set_relationship($rels_ext, ISLANDORA_RELS_EXT_URI, 'isPageOf', $params['parent']);
}

/**
 * Implements hook_css_alter().
 */
function sdsu_theme_css_alter(&$css) {
  $exclude = array(
    'sites/all/modules/islandora_solution_pack_collection/css/islandora_basic_collection.base.css' => FALSE,
    'sites/all/modules/islandora_solution_pack_collection/css/islandora_basic_collection.theme.css ' => FALSE,
  );
  $css = array_diff_key($css, $exclude);
}

/**
 * Implements HOOK_views_pre_render();
 */
function sdsu_theme_views_pre_render(&$view) {
  if ($view->name=='subsequent_pages') {
    foreach($view->result as $r => $result) {
      $view->result[$r]->{'SORT_BY_ME'} = intval($view->result[$r]->{'RELS_EXT_isPageNumber_literal_s'});
    }
    usort($view->result, 'sort_objects_by_page_num');
  }
}
/**
 * Helper function, sorts
 * @param unknown $a
 * @param unknown $b
 * @return number
 */
function sort_objects_by_page_num($a, $b) {
  if($a->{'SORT_BY_ME'} == $b->{'SORT_BY_ME'}){
    return 0;
  }
  return ($a->{'SORT_BY_ME'} < $b->{'SORT_BY_ME'}) ? -1 : 1;
}


/**
 * Implements hook_preprocess().
 */
function sdsu_theme_preprocess_islandora_book_page(&$variables) {
  $variables['classes_array'][] = 'islandora-object-template';
  $object = menu_get_object('islandora_object', 2);
  $relationships = $object->relationships->get(ISLANDORA_RELS_EXT_URI, 'isPageOf');
  if (!empty($relationships)) {
    $progression = reset($relationships);
    //return 'info:fedora/' . $progression['object']['value'];
    $variables['subsequent_pages'] = views_embed_view('subsequent_pages', 'block', 'info:fedora/' . $progression['object']['value']);
  }

}

/**
 * Implements hook_preprocess_page().=
 */
function sdsu_theme_preprocess_page(&$vars) {
  $logos = array(
    'sdsu_theme_use_first_header',
    'sdsu_theme_use_second_header',
    'sdsu_theme_use_first_footer',
    'sdsu_theme_use_second_footer',
  );
  foreach ($logos as $logo) {
    // Set logos to the uploaded files.
    if (theme_get_setting($logo . '_default') != 1) {
      $fid = theme_get_setting($logo . '_file');
      if (!is_null($fid)) {
        $vars[$logo . "_logo"] = file_create_url(file_load($fid)->uri);
      }
    }
    // Set logos to the defaults in the theme.
    else {
      $vars[$logo . "_logo"] = drupal_get_path('theme', 'sdsu_theme') . "/logos/" . $logo . "_logo.png";
    }
  }

  if (!$vars['is_front']) {
    $vars['simple_search'] = sdsu_theme_block_render('islandora_solr', 'simple');

  }
  $vars['header_arg'] = arg(0);
  $vars['facet_header_arg'] = arg(1);
}

/**
 * Helper function to render block dynamically.
 *
 * @param unknown $module
 * @param unknown $delta
 * @param string $as_renderable
 * @return unknown
 */
function sdsu_theme_block_render($module, $delta, $as_renderable = FALSE) {
  $block = block_load($module, $delta);
  $block_content = _block_render_blocks(array($block));
  $build = _block_get_renderable_array($block_content);
  if ($as_renderable) {
    return $build;
  }
  $block_rendered = drupal_render($build);
  return $block_rendered;
}
