<?php
/**
 * @file
 * Contains the theme's settings form.
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function sdsu_theme_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL) {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  $form['sdsu_theme']['retrievium_background_dsid'] = array(
    '#type' => 'textfield',
    '#title' => t('Slideshow Image Datastream.'),
    '#default_value' => theme_get_setting('retrievium_background_dsid'),
    '#description' => t("Use this datastream as the front page slideshow image source. Defaults to TN"),
  );

  $form['sdsu_theme']['header_images'] = array(
    '#type' => 'fieldset',
    '#title' => t('Header Images'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['sdsu_theme']['header_images']['sdsu_theme_use_first_header_default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use default first header logo.'),
    '#default_value' => 1,
  );

  $form['sdsu_theme']['header_images']['sdsu_theme_use_first_header_file'] = array(
    '#type'     => 'managed_file',
    '#title'    => t('First Header logo'),
    '#required' => FALSE,
    '#upload_location' => file_default_scheme() . '://theme/backgrounds/',
    '#default_value' => theme_get_setting('sdsu_theme_use_first_header_file'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
    ),
    '#states' => array(
      'visible' => array(
        ':input[name="sdsu_theme_use_first_header_default"]' => array('checked' => FALSE),
      ),
     'required' => array(
        ':input[name="sdsu_theme_use_first_header_default"]' =>  array('checked' => FALSE)
      ),
    ),
  );

  $form['sdsu_theme']['header_images']['sdsu_theme_use_second_header_default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use default second header logo.'),
    '#default_value' => 1,
  );

  $form['sdsu_theme']['header_images']['sdsu_theme_use_second_header_file'] = array(
    '#type'     => 'managed_file',
    '#title'    => t('Second Header Logo'),
    '#required' => FALSE,
    '#upload_location' => file_default_scheme() . '://theme/backgrounds/',
    '#default_value' => theme_get_setting('sdsu_theme_use_second_header_file'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
    ),
    '#states' => array(
      'visible' => array(
        ':input[name="sdsu_theme_use_second_header_default"]' => array('checked' => FALSE),
      ),
      'required' => array(
        ':input[name="sdsu_theme_use_second_header_default"]' =>  array('checked' => FALSE)
      ),
    ),
  );

  $form['sdsu_theme']['footer_images'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer Images'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['sdsu_theme']['footer_images']['sdsu_theme_use_first_footer_default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use default first footer logo.'),
    '#default_value' => 1,
  );

  $form['sdsu_theme']['footer_images']['sdsu_theme_use_first_footer_file'] = array(
    '#type'     => 'managed_file',
    '#title'    => t('First Footer logo'),
    '#required' => FALSE,
    '#upload_location' => file_default_scheme() . '://theme/backgrounds/',
    '#default_value' => theme_get_setting('sdsu_theme_use_first_footer_file'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
    ),
    '#states' => array(
      'visible' => array(
        ':input[name="sdsu_theme_use_first_footer_default"]' => array('checked' => FALSE),
      ),
     'required' => array(
        ':input[name="sdsu_theme_use_first_footer_default"]' =>  array('checked' => FALSE)
      ),
    ),
  );

  $form['sdsu_theme']['footer_images']['sdsu_theme_use_second_footer_default'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use default second footer logo.'),
    '#default_value' => 1,
  );

  $form['sdsu_theme']['footer_images']['sdsu_theme_use_second_footer_file'] = array(
    '#type'     => 'managed_file',
    '#title'    => t('Second Footer Logo'),
    '#required' => FALSE,
    '#upload_location' => file_default_scheme() . '://theme/backgrounds/',
    '#default_value' => theme_get_setting('sdsu_theme_use_second_footer_file'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
    ),
    '#states' => array(
      'visible' => array(
        ':input[name="sdsu_theme_use_second_footer_default"]' => array('checked' => FALSE),
      ),
      'required' => array(
        ':input[name="sdsu_theme_use_second_footer_default"]' =>  array('checked' => FALSE)
      ),
    ),
  );

  // Create the form using Forms API: http://api.drupal.org/api/7

  /* -- Delete this line if you want to use this setting
  $form['ir7_saas_example'] = array(
  '#type'          => 'checkbox',
  '#title'         => t('ir7_saas sample setting'),
  '#default_value' => theme_get_setting('ir7_saas_example'),
  '#description'   => t("This example option doesn't do anything."),
  );
  // */

  /* -- Delete this line if you want to remove this base theme setting.
  // We don't need breadcrumbs to be configurable on this site.
  unset($form['breadcrumb']);
  // */

  // We are editing the $form in place, so we don't need to return anything.
}
