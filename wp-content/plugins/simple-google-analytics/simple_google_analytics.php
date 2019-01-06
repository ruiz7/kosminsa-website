<?php
	/**
	 * Plugin Name: Webcraftic Local Google Analytics
	 * Plugin URI: https://wordpress.org/plugins/simple-google-analytics/
	 * Description: Old plugin name: Simple Google Analytics. To improve Google Page Speed indicators Analytics caching is needed. However, it can also slightly increase your website loading speed, because Analytics js files will load locally. The second case that you might need these settings is the usual Google Analytics connection to your website. You do not need to do this with other plugins or insert the tracking code into your theme.
	 * Author: Webcraftic <wordpress.webraftic@gmail.com>, JeromeMeyer62<jerome.meyer@hollywoud.net>
	 * Version: 3.0.0
	 * Text Domain: simple-google-analytics
	 * Domain Path: /languages/
	 * Author URI: http://clearfy.pro
	 */

	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}

	// If the plugin is already in use, as an add-on or has already been installed.
	$conflict_error = defined('WGA_PLUGIN_ACTIVE') || (defined('WCL_PLUGIN_ACTIVE') && !defined('LOADING_GA_CACHE_AS_ADDON'));

	// If the user is using an old version of Wordpress
	$old_wp_version_error = version_compare(get_bloginfo('version'), '4.2.0') <= 0;

	if( $conflict_error || $old_wp_version_error ) {
		function wbcr_ga_admin_notice_error()
		{
			global $conflict_error, $old_wp_version_error;

			if( $conflict_error ) {
				?>
				<div class="notice notice-error">
					<p><?php _e('We found that you have the "Clearfy - disable unused features" plugin installed, this plugin already has Google Analytics cache functions, so you can deactivate plugin "Google Analytics Cache"!', 'simple-google-analytics'); ?></p>
				</div>
			<?php
			}

			if( $old_wp_version_error ) {
				?>
				<div class="notice notice-error">
					<p><?php _e('You use the old version of Wordpress to use the <b>Webcraftic Local Google Analytics (Old name: Simple Google Analytics)</b> plugin, you must upgrade your Wordpress to the minimum version 4.2!', 'simple-google-analytics'); ?></p>
				</div>
			<?php
			}
		}

		add_action('admin_notices', 'wbcr_ga_admin_notice_error');
	} else {

		define('WGA_PLUGIN_ACTIVE', true);
		define('WGA_PLUGIN_DIR', dirname(__FILE__));
		define('WGA_PLUGIN_BASE', plugin_basename(__FILE__));
		define('WGA_PLUGIN_URL', plugins_url(null, __FILE__));

		if( !defined('LOADING_GA_CACHE_AS_ADDON') ) {
			require_once(WGA_PLUGIN_DIR . '/libs/factory/core/boot.php');
		}

		require_once(WGA_PLUGIN_DIR . '/includes/class.plugin.php');

		if( !defined('LOADING_GA_CACHE_AS_ADDON') ) {

			new WGA_Plugin(__FILE__, array(
				'prefix' => 'wbcr_gac_',
				'plugin_name' => 'wbcr_gac',
				'plugin_title' => __('Webcraftic Local Google Analytics', 'simple-google-analytics'),
				'plugin_version' => '3.0.0',
				'required_php_version' => '5.2',
				'required_wp_version' => '4.2',
				'plugin_build' => 'free',
				//'updates' => WGA_PLUGIN_DIR . '/updates/'
			));
		}
	}