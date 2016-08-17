<?php

/**
 * @file
 * islandora-solr-facet-pages-results.tpl.php
 * Islandora solr template file for facet results
 *
 * Variables available:
 * - $variables: all array elements of $variables can be used as a variable. e.g. $base_url equals $variables['base_url']
 * - $base_url: The base url of the current website. eg: http://example.com .
 * - $user: The user object.
 *
 * - $results: Array containing search results to render
 * - $solr_field: Facet solr field to be used to create url's including a filter
 *
 */

?>

<?php $chunk = array_chunk($results, 2, TRUE);?>
<div class="islandora-solr-facet-pages-results">
  <table class="views-view-grid cols-2">
    <tbody>
      <?php for ($i = 0; $i < count($chunk); $i++) :?>
        <tr class="row-1 row-first">
          <?php foreach ($chunk[$i] as $key => $value):?>
          <td>
            <div class="views-field-PID">
              <span class="field-content">
                <?php $filter = $solr_field . ':"' . addslashes($key) . '"'; ?>
                <?php $render_icon = array(
                  'link' => array(
                  '#type' => 'link',
                  '#title' => '<div><i class="facet-icon fa fa-building-o fa-5" aria-hidden="true"></i></div>',
                  '#href' => 'islandora/search/*:*',
                  '#options' => array(
                    'html' => TRUE,
                      'query' => array('f' => array($filter)),
                   )
                 ),
               ); print drupal_render($render_icon);?>
              <h2><?php print l($key, 'islandora/search/*:*', array('query' => array('f' => array($filter)))); ?><span class="bucket-size">(<?php print $value; ?>)</span></h2>
              </span>
            </div>
            <div></div>
            <div></div>
            <div></div>
          </td>
          <?php endforeach;?>
        </tr>
      <?php endfor;?>
    </tbody>
  </table>
</div>