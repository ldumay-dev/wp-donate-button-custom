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
     * Réglages enregistrés de la page dans la base de données :
     * - wp_dbc_set_visibility
     * - wp_dbc_set_color
     * - wp_dbc_set_position
     * - wp_dbc_set_effect
     * - wp_dbc_set_icone_type
     * - wp_dbc_set_icone_wp_dash
     * - wp_dbc_set_icone_wp_media
     * - wp_dbc_set_texte
     * - wp_dbc_set_options_number
     * - wp_dbc_set_option_1_title
     * - wp_dbc_set_option_1_link
     * - wp_dbc_set_option_2_title
     * - wp_dbc_set_option_2_link
     * - wp_dbc_set_option_3_title
     * - wp_dbc_set_option_3_link
     * - wp_dbc_set_option_4_title
     * - wp_dbc_set_option_4_link
     */
    
    /**
     * Ajouter les options par défaut à l'activation
     * 
     * @return void
     */
    function wp_donate_button_custom_enable(){
        add_option('wp_dbc_set_visibility', 'true');
        add_option('wp_dbc_set_color', '#0073aa');
        add_option('wp_dbc_set_position', 'bottom-right');
        add_option('wp_dbc_set_effect', 'hover_medium');
        add_option('wp_dbc_set_icone_type', 'icone_wp_dash');
        add_option('wp_dbc_set_icone_wp_dash', 'dashicons-heart');
        add_option('wp_dbc_set_icone_wp_media', '');
        add_option('wp_dbc_set_texte', 'Ceci est un bouton de don');
        add_option('wp_dbc_set_options_number', 2);
        add_option('wp_dbc_set_option_1_title', 'Option 1');
        add_option('wp_dbc_set_option_1_link', 'https://example.com');
        add_option('wp_dbc_set_option_2_title', 'Option 2');
        add_option('wp_dbc_set_option_2_link', 'https://example.com');
        add_option('wp_dbc_set_option_3_title', 'Option 3');
        add_option('wp_dbc_set_option_3_link', 'https://example.com');
        add_option('wp_dbc_set_option_4_title', 'Option 4');
        add_option('wp_dbc_set_option_4_link', 'https://example.com');
    }

    /**
     * Supprimer les options à la désactivation
     */
    function wp_donate_button_custom_disable(){
        delete_option('wp_dbc_set_visibility');
        delete_option('wp_dbc_set_color');
        delete_option('wp_dbc_set_position');
        delete_option('wp_dbc_set_effect');
        delete_option('wp_dbc_set_icone_type');
        delete_option('wp_dbc_set_icone_wp_dash');
        delete_option('wp_dbc_set_icone_wp_media');
        delete_option('wp_dbc_set_texte');
        delete_option('wp_dbc_set_options_number');
        delete_option('wp_dbc_set_option_1_title');
        delete_option('wp_dbc_set_option_1_link');
        delete_option('wp_dbc_set_option_2_title');
        delete_option('wp_dbc_set_option_2_link');
        delete_option('wp_dbc_set_option_3_title');
        delete_option('wp_dbc_set_option_3_link');
        delete_option('wp_dbc_set_option_4_title');
        delete_option('wp_dbc_set_option_4_link');
    }