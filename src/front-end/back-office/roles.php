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
     * Add a custom role to the WordPress roles
     * 
     * @return void
     */
    function wp_donate_button_custom_create_custom_role() {
        // Create and add the custom role
        add_role(
            // The name of the role
            WP_DBC_ROLE,
            // The display name of the role
            WP_DBC_ROLE_NAME,
            // List of the capabilities
            array(
                // The basic rights of using the WordPress dashboard
                'read' => true,
                
                // The capabilities of the plugin
                WP_DBC_CAPABILITY => true, // Main capability
                WP_DBC_CAPABILITY_DEV => false, // Development capability
            )
        );
    }

    /**
     * Update the capabilities status of the administrator role
     */
    function wp_donate_button_custom_update_administrator_capabilities() {
        // Get the administrator role
        $administrator = get_role('administrator');
        // Check if the role exists
        if ($administrator) {
            // Update the main capabitlity of the administrator role to true
            $administrator->remove_cap(WP_DBC_CAPABILITY);
            $administrator->add_cap(WP_DBC_CAPABILITY, true);
            // Update the development capabitlity of the administrator role to true
            $administrator->remove_cap(WP_DBC_CAPABILITY_DEV);
            $administrator->add_cap(WP_DBC_CAPABILITY_DEV, true);
        }
    }

    /**
     * Remove the custom role from the WordPress roles
     * 
     * @return void
     */
    function wp_donate_button_custom_remove_custom_role() {
        // The name of the custom role
        $custom_role = WP_DBC_ROLE;
        // Get all users with the custom role
        $users = get_users(array(
            'role' => $custom_role
        ));
        // Get the default role of WordPress
        $default_role = get_option('default_role');
        // Assign the default role to all users with the custom role
        foreach ($users as $user) {
            $user->set_role($default_role);
        }
        // Remove the custom role
        remove_role($custom_role);
    }