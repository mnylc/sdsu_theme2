<?php
/**
 * @file
 * Islandora solr search results wrapper template
 *
 * Variables available:
 * - $variables: all array elements of $variables can be used as a variable.
 *   e.g. $base_url equals $variables['base_url']
 * - $base_url: The base url of the current website. eg: http://example.com .
 * - $user: The user object.
 *
 * - $secondary_profiles: Rendered secondary profiles
 * - $results: Rendered search results (primary profile)
 * - $islandora_solr_result_count: Solr result count string
 * - $solrpager: The pager
 * - $solr_debug: debug info
 *
 * @see template_preprocess_islandora_solr_wrapper()
 */
?>
<div class="search-results">
  <div class="your-search">
    <?php if (isset($your_search)) :?>
      <?php print $your_search;?>
    <?php endif;?>
  </div>
  <div class="search-tools">
    <div class="search-count-sort">
      <div id="islandora-solr-result-count">
        <?php print $islandora_solr_result_count; ?>
      </div>
      <div class="sort-by">
        <?php if (isset($solr_sort)) :?>
          <?php print $solr_sort;?>
        <?php endif;?>
      </div>
    </div>
    <div class="solr-current-query">
      <?php if (isset($solr_current_query)) :?>
        <?php print $solr_current_query;?>
      <?php endif;?>
    </div>
  </div>
</div>
<div id="islandora-solr-top">
  <?php print $secondary_profiles; ?>
</div>
<div class="islandora-solr-content">
  <?php print $solr_pager; ?>
  <?php print $results; ?>
  <?php print $solr_debug; ?>
  <?php print $solr_pager; ?>
</div>
