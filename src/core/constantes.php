<?php
    /**
     * Plugin Name: WP Donate Button Custom
     * Author: ldumay
     */

    // WordPress Security - Check if the file is called by WordPress
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

    /**
     * Set the constants of the plugin
     * 
     * @param string $plugin_version
     * @param string $plugin_name
     * @param string $plugin_name_lite
     * 
     * @return boolean
     */
    function wp_donate_button_custom_set_constantes($plugin_version, $plugin_name, $plugin_name_lite, $plugin_dir_path, $plugin_dir_url) {
        // --- [ Constants of the plugin ] ---
        // Plugin version
        if ( ! defined( 'WP_DBC_VERSION' ) ) {
            define('WP_DBC_VERSION', $plugin_version);
        }
        // Plugin name
        if ( ! defined( 'WP_DBC_NAME' ) ) {
            define('WP_DBC_NAME', $plugin_name);
        }
        // Plugin name lite
        if ( ! defined( 'WP_DBC_NAME_LITE' ) ) {
            define('WP_DBC_NAME_LITE', $plugin_name_lite);
        }
        // Plugin slug
        if ( ! defined( 'WP_DBC_NAME_SLUG' ) ) {
            $result = strtolower(WP_DBC_NAME);
            $result = str_replace(' ', '-', $result);
            define('WP_DBC_NAME_SLUG', $result);
        }
        // Plugin slug underscore
        if ( ! defined( 'WP_DBC_NAME_SLUG_UNDERSCORE' ) ) {
            $result = strtolower(WP_DBC_NAME);
            $result = str_replace(' ', '_', $result);
            define('WP_DBC_NAME_SLUG_UNDERSCORE', $result);
        }
        // Plugin url
        if ( ! defined( 'WP_DBC_URL' ) ) {
            define('WP_DBC_URL', $plugin_dir_url);
        }
        // Plugin path
        if ( ! defined( 'WP_DBC_PATH' ) ) {
            define('WP_DBC_PATH', $plugin_dir_path);
        }
        // Menu position in the admin
        if ( ! defined( 'WP_DBC_MENU_POSITION' ) ) {
            define('WP_DBC_MENU_POSITION', 3);
        }

        // --- [ Constants of the capabilities ] ---
        // Main capability
        if ( ! defined( 'WP_DBC_CAPABILITY' ) ) {
            define('WP_DBC_CAPABILITY', WP_DBC_NAME_SLUG_UNDERSCORE.'_capability');
        }
        // Development capability
        if ( ! defined( 'WP_DBC_CAPABILITY_DEV' ) ) {
            define('WP_DBC_CAPABILITY_DEV', WP_DBC_CAPABILITY.'_dev');
        }

        // --- [ Constants of the roles ] ---
        // Id of the role model of a specific user for the module
        if( ! defined('WP_DBC_ROLE') ) {
            define('WP_DBC_ROLE', WP_DBC_NAME_SLUG_UNDERSCORE);
        }
        // Name of the role model of a specific user for the module
        if( ! defined('WP_DBC_ROLE_NAME') ) {
            define('WP_DBC_ROLE_NAME', WP_DBC_NAME_LITE.' (model)');
        }
        
        // --- [ Control of the function ] ---
        if( defined('WP_DBC_VERSION') && defined('WP_DBC_NAME')
            && defined('WP_DBC_NAME_LITE') && defined('WP_DBC_NAME_SLUG')
            && defined('WP_DBC_NAME_SLUG_UNDERSCORE') && defined('WP_DBC_URL')
            && defined('WP_DBC_PATH') && defined('WP_DBC_MENU_POSITION')
            && defined('WP_DBC_CAPABILITY') && defined('WP_DBC_CAPABILITY_DEV')
            && defined('WP_DBC_ROLE') && defined('WP_DBC_ROLE_NAME') ) {
            return true;
        } else {
            return false;
        }
    }