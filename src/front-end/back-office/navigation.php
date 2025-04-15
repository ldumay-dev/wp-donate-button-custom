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
     * Add a separator in the WordPress administration menu
     * 
     * @param int $position
     * 
     * @return void
     */
    function wp_donate_button_custom_admin_menu_separator($position) {
        global $menu;
        $menu[$position] = array(
            '', // Le titre du menu vide
            WP_DBC_CAPABILITY, // Capacité nécessaire
            'separator'.$position, // Slug unique pour le séparateur
            '', // Nom affiché
            'wp-menu-separator' // Classe CSS spécifique pour un séparateur
        );
    }

    /**
     * Add the menu to the admin
     */
    function wp_donate_button_custom_admin_menu() {
        $slug_main = WP_DBC_NAME_SLUG;
        $callback_main = 'wp_donate_button_custom_page_admin';
        $capability = WP_DBC_CAPABILITY;

        // Add a separator in the admin menu
        wp_donate_button_custom_admin_menu_separator(WP_DBC_MENU_POSITION);

        /**
         * Add a main menu to the admin
         */
        add_menu_page(
            WP_DBC_NAME, // Page Title
            WP_DBC_NAME_LITE, // Menu Title
            $capability, // Capability
            $slug_main, // Main slug
            $callback_main, // Callback function to display the admin page
            'dashicons-heart', // Icon of the menu
            WP_DBC_MENU_POSITION // Position of the menu
        );

        /**
         * Add a submenu to the admin page
         */
        add_submenu_page(
            $slug_main, // Parent slug
            __( WP_DBC_NAME, 'wp-dbc' ), // Page Title
            __( WP_DBC_NAME_LITE, 'wp-dbc' ), // Submenu Title
            $capability, // Capability
            $slug_main, // Slug of the submenu (same as the parent to display the main page)
            $callback_main // Callback function to display the admin page
        );

        /**
         * Add a submenu to the info page
         */
        add_submenu_page(
            $slug_main, // Parent slug
            'À propos de '.WP_DBC_NAME, // Page Title
            'À propos', // Submenu Title
            $capability, // Capability
            WP_DBC_NAME_SLUG.'-info', // Slug of the submenu
            WP_DBC_NAME_SLUG_UNDERSCORE.'_page_info' // Callback function to display the info page
        );

        /**
         * Add a submenu to the info page
         */
        add_submenu_page(
            $slug_main, // Parent slug
            'Dev. Infos. - '.WP_DBC_NAME, // Page Title
            'Dev. Infos.', // Submenu Title
            WP_DBC_CAPABILITY_DEV, // Capability
            WP_DBC_NAME_SLUG.'-dev', // Slug of the submenu
            WP_DBC_NAME_SLUG_UNDERSCORE.'_page_dev' // Callback function to display the info page
        );
    }

    /**
     * Add a shortcut in the WordPress administration bar
     */
    function wp_donate_button_custom_admin_bar_menu($admin_bar) {
        // Check if the user has the ability to view the page
        if (current_user_can(WP_DBC_CAPABILITY)) {
            // Preapre the shortcut
            $args = array(
                // The shortcut ID
                'id'    => WP_DBC_NAME_SLUG_UNDERSCORE.'_bouton',
                // The title of the shortcut (with the icon)
                'title' => '<span class="ab-icon dashicons dashicons-heart"></span>'
                    .'<span class="ab-label">'
                    .WP_DBC_NAME_LITE
                    .'</span>',
                // The link of the shortcut
                'href'  => admin_url('admin.php?page='.WP_DBC_NAME_SLUG),
                // The meta of the shortcut
                'meta'  => array(
                    // CSS class of the shortcut
                    'class' => WP_DBC_NAME_SLUG.'-bouton-diplome',
                    // Title of the shortcut
                    'title' => 'Accés rapide à '.WP_DBC_NAME,
                ),
            );
            // 
            $admin_bar->add_node($args);
        }
    }