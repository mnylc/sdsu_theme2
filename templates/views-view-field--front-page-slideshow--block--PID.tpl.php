<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<div class="front-page-slideshow-wrapper">
  <a href="/islandora/object/<?php print $output;?>" title="<?php print $row->{'dc.title'}[0]?>">
    <div
      class="front-page-slideshow-image"
      style="background: url(/islandora/object/<?php print $output; ?>/datastream/<?php print theme_get_setting('ir7_saas_background_dsid');?>/view) no-repeat center; background-size: cover;">
     </div>
   </a>
</div>