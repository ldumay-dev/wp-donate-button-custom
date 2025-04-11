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
     * Informations :
     * - the capabilities and the roles are linked
     * - a capability is a permission that can be assigned to a role 
     * - the capabilities are always added to all roles
     */

    /**
     * Add the capabilities of the plugin to the roles
     * 
     * @return void
     */
    function wp_donate_button_custom_add_capabilities() {
        // List of the capabilities
        $capabilities = [
            WP_DBC_CAPABILITY, // Main capability
            WP_DBC_CAPABILITY_DEV, // Development capability
        ];
        // Call all the roles of WordPress
        $roles = wp_roles()->role_objects;
        
        // Browse all roles
        foreach($roles as $role) {
            // Browse all capabilities
            foreach ($capabilities as $capability) {
                // Check if the role exists and does not already have the capability
                if ($role && $role->has_cap($capability)) {
                    $role->add_cap($capability); // Add the capability to the role
                }
            }
        }
    }

    /**
     * Remove the capabilities of the plugin to the roles
     */
    function wp_donate_button_custom_remove_capabilities() {
        // List of the capabilities
        $capabilities = [
            WP_DBC_CAPABILITY, // Main capability
            WP_DBC_CAPABILITY_DEV, // Development capability
        ];
        // Call all the roles of WordPress
        $roles = wp_roles()->role_objects;
        // Browse all roles
        foreach($roles as $role) {
            // Browse all capabilities
            foreach ($capabilities as $capability) {
                // Check if the role exists and has the capability
                if ($role && $role->has_cap($capability)) {
                    $role->remove_cap($capability); // Remove the capability to the role
                }
            }
        }
    }