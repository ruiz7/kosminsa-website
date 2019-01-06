<?php

/**
 * Class FMModelOptions_fmc
 */
class FMModelOptions_fmc extends CFMAdminModel {
  /**
   * Save data to DB.
   */
  public function save_db() {
	$option_key = (WDFMInstance(self::PLUGIN)->is_free == 2 ? 'fmc_settings' : 'fm_settings');
	$fm_settings = get_option($option_key);
    $public_key = WDW_FM_Library(self::PLUGIN)->get('public_key', '');
    $private_key = WDW_FM_Library(self::PLUGIN)->get('private_key', '');
    $csv_delimiter = (isset($_POST['csv_delimiter']) && $_POST['csv_delimiter'] != '' ? esc_html(stripslashes($_POST['csv_delimiter'])) : ',');
    $fm_shortcode = (isset($_POST['fm_shortcode']) ? "old" : '');
    $fm_advanced_layout = WDW_FM_Library(self::PLUGIN)->get('fm_advanced_layout', '0');
    $fm_enable_wp_editor = WDW_FM_Library(self::PLUGIN)->get('fm_enable_wp_editor', '1');
    $map_key = WDW_FM_Library(self::PLUGIN)->get('map_key', '');
    update_option( $option_key, array(
      'public_key' => $public_key,
      'private_key' => $private_key,
      'csv_delimiter' => $csv_delimiter,
      'map_key' => $map_key,
      'fm_shortcode' => $fm_shortcode,
      'fm_advanced_layout' => $fm_advanced_layout,
	    'fm_enable_wp_editor' => $fm_enable_wp_editor,
	  'ajax_export_per_page' => !empty($fm_settings['ajax_export_per_page']) ? $fm_settings['export_per_page'] : 1000
    ));
    return 8;
  }
}
