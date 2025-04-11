<?php
	/**
	 * Text Domain:       	wp-donate-button-custom
	 * Plugin Name:          WP Donate Button Custom
      * Plugin URI:           https://wordpress.ldumay.fr/plugins/wp-donate-button-custom
      * Description:          It's a plugin to add a custom donate button in WordPress.
      * Requires at least:    6.0
      * Requires PHP:         7.0
      * php version:          7.0
      * Version:              1.0.0
      * Author:               @ldumay
      * Author URI:           https://ldumay.fr
      * License:              GPLv3
      * License URI:          https://www.gnu.org/licenses/gpl-3.0.html
      */

	// WordPress Security - Check if the file is called by WordPress
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

     // Variables
     define('WP_DBC_PATH', plugin_dir_path(__FILE__));
     define('WP_DBC_URL', plugin_dir_url(__FILE__));

     // - - - [ Constants and global variables ] - - -
	// set global variable for current user.
	global $current_logged_in_wp_user;
	// Include the constantes file to set the constants
     require_once WP_DBC_PATH.'src/core/constantes.php';
     $state_constantes = wp_donate_button_custom_set_constantes(
          '1.0.0', // Plugin version
          'WP Donate Button Custom', // Plugin name
          'WP DBC', // Plugin name lite
          WP_DBC_PATH, // Plugin directory path
          WP_DBC_URL, // Plugin directory url
     );

     // Check if the function is not already defined
     if ( ! function_exists( 'is_plugin_active' ) ) {
          include_once( ABSPATH.'wp-admin/includes/plugin.php' );
     }

     // Includes with order
     // => Core
     require_once WP_DBC_PATH.'src/core/classes/wp-donate-button-custom.php';
     require_once WP_DBC_PATH.'src/core/functions/wp-donate-button-custom.php';
     // => Setup
     require_once WP_DBC_PATH.'src/setup/install-and-uninstall.php';
     require_once WP_DBC_PATH.'src/setup/enable-and-disable.php';
     require_once WP_DBC_PATH.'src/setup/update.php';
     // => Back-end
     require_once WP_DBC_PATH.'src/back-end/wp-donate-button-custom.php';
     // => Front-end
     // -> Front-office
     require_once WP_DBC_PATH.'src/front-end/front-office/render.php';
     // -> Back-office
     require_once WP_DBC_PATH.'src/front-end/back-office/about.php';
     require_once WP_DBC_PATH.'src/front-end/back-office/capabilities.php';
     require_once WP_DBC_PATH.'src/front-end/back-office/roles.php';
     require_once WP_DBC_PATH.'src/front-end/back-office/navigation.php';
     require_once WP_DBC_PATH.'src/front-end/back-office/settings.php';
     require_once WP_DBC_PATH.'src/front-end/back-office/shortcode.php';
     require_once WP_DBC_PATH.'src/front-end/back-office/widget.php';
     // => Assets
     require_once WP_DBC_PATH.'src/assets/css/wp-donate-button-custom.css';
     require_once WP_DBC_PATH.'src/assets/js/wp-donate-button-custom.js';
     // => Translation
     // require_once WP_DBC_PATH.'src/languages/wp-donate-button-custom.php';

     // - - - [ Hooks ] - - -
		// NB : I think, the hooks can be used only in this file.

          /*

		// => The hooks for the activation, update and uninstall
		// -> Activation
		// Plugin activation
		register_activation_hook( __FILE__, "wp_donate_button_custom_activation" );
		// Database initialization
		register_activation_hook(__FILE__, 'wp_donate_button_custom_join_class_page');
		// -> Update
		add_action('upgrader_process_complete', 'wp_donate_button_custom_update', 10, 2);
		// -> Uninstall
		// Register uninstall hook
		register_uninstall_hook(__FILE__, 'wp_donate_button_custom_class_page');
		// Register uninstall hook
		register_uninstall_hook(__FILE__, 'wp_donate_button_custom_uninstall_cleanup');

          */

		// => The hooks for the capabilities is in the capabilities.php file
		// Enable the capabilities
		// add_action('admin_init', 'wp_donate_button_custom_add_capabilities');
		register_activation_hook(__FILE__, 'wp_donate_button_custom_add_capabilities');
		// Disable the capabilities
		register_deactivation_hook(__FILE__, 'wp_donate_button_custom_remove_capabilities');

		// => The hooks for the roles is in the roles.php file
		// Enable the roles
		register_activation_hook(__FILE__, 'wp_donate_button_custom_create_custom_role');
		register_activation_hook(__FILE__, 'wp_donate_button_custom_update_administrator_capabilities');
		// Disable the roles
		register_deactivation_hook(__FILE__, 'wp_donate_button_custom_remove_custom_role');