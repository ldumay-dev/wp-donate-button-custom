<?php
    /**
     * Plugin Name: WP Donate Button Custom
     * Author: ldumay
     */

    // WordPress Security - Check if the file is called by WordPress
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

    // Composer import
    use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

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

    /**
     * Composer autoload
     * @param string $path // Path to the plugin directory
     */
    function wp_donate_button_custom_autoload($path) {
        if (file_exists($path . '/vendor/autoload.php')) {
            require_once $path . '/vendor/autoload.php';
        } else {
            // If the autoload file is not found, display an error message
            add_action('admin_notices', function() {
                echo '<div class="error"><p>WP Donate Button Custom: Composer autoload file not found.</p></div>';
            });
        }
    }

    /**
     * Update checker
     * @param string $plugin_dir_path // Path to the plugin directory
     * @param string $plugin_slug // Slug of the plugin
     * @param string $github_repo // GitHub repository URL
     * @param string $github_branch // Branch to check for updates
     */
    function wp_donate_button_custom_update_checker($plugin_dir_path, $plugin_slug, $github_repo, $github_branch, $github_token) {
        // Create an instance of the update checker
        $updateChecker = PucFactory::buildUpdateChecker(
            $github_repo, /* GitHub repository URL */
            $plugin_dir_path . '/wp-donate-button-custom.php', /* Path to the main plugin file */
            $plugin_slug /* Unique identifier for the plugin */
        );
        // Set the branch that contains the stable release for updates
        $updateChecker->setBranch($github_branch);
        // Optional: If you're using a private repository, specify the access token like this:
	    if( !empty($github_token) && $github_token != 'null' ) {
            // Set the access token for authentication
            // This is required for private repositories or if you want to avoid rate limits.
            $updateChecker->setAuthentication($github_token);
        }
    }

    /**
     * Convertion of color from hex to rgba
     */
    function wp_donate_button_custom_hex2rgba($hex, $opacity = 1) {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 6) {
            list($r, $g, $b) = array($hex[0].$hex[1], $hex[2].$hex[3], $hex[4].$hex[5]);
        } elseif (strlen($hex) == 3) {
            list($r, $g, $b) = array($hex[0].$hex[0], $hex[1].$hex[1], $hex[2].$hex[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return 'rgba('.$r.', '.$g.', '.$b.', '.$opacity.')';
    }