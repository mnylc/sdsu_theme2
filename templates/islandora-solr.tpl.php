<?php
/**
 * @file
 * Islandora solr search primary results template file.
 *
 * Variables available:
 * - $results: Primary profile results array
 *
 * @see template_preprocess_islandora_solr()
 */

?>
<?php if (empty($results)): ?>
  <p class="no-results"><?php print t('Sorry, but your search returned no results.'); ?></p>
<?php else: ?>
  <div class="islandora islandora-solr-search-results">
    <?php $row_result = 0; ?>
    <?php foreach($results as $key => $result): ?>
      <!-- Search result -->
      <div class="islandora-solr-search-result clear-block <?php print $row_result % 2 == 0 ? 'odd' : 'even'; ?>">
        <div class="islandora-solr-search-result-inner">
          <!-- Thumbnail -->
          <dl class="solr-thumb">
            <dt>
              <?php print $result['thumbnail']; ?>
            </dt>
            <dd></dd>
          </dl>
          <!-- Metadata -->
          <dl class="solr-fields islandora-inline-metadata">
            <?php $first = TRUE;?>
            <?php $link_text = "";?>
            <?php foreach($result['solr_doc'] as $key => $value): ?>
              <?php $first_class = "";?>

              <?php if ($first):?>
                <?php $value['class'] .= " solr-first-meta"?>
                <?php $first = FALSE;?>
                <?php $link_text = $value['value'];?>
              <?php endif;?>

              <?php $label_class = !empty($value['label']) && $value['label'] != "<none>" ? "label-value" : "label-empty" ;?>
              <dt class="solr-label <?php print $value['class']; ?> <?php print $label_class;?>">
                <?php print $value['label']; ?>
              </dt>
              <dd class="solr-value <?php print $value['class']; ?>">
                <?php print $value['value']; ?>
              </dd>
            <?php endforeach; ?>
          </dl>
        </div>
      </div>
    <?php $row_result++; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
