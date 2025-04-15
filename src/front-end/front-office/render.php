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
     * Enqueue Dashicons
     */
    function wp_donate_button_custom_enqueue_dashicons() {
        wp_enqueue_style('dashicons');
    }

    /**
     * Render the button
     */
    function wp_donate_button_custom_render_button() {
        if ((is_page() || is_front_page()) && !is_admin()) {
            $couleur = esc_attr(get_option('wp_dbc_set_color', '#0073aa'));
            $position = get_option('wp_dbc_set_position', 'bottom-right');
            $icone = esc_attr(get_option('wp_dbc_set_icone_wp_dash', 'dashicons-heart'));
            $texte = esc_html(get_option('wp_dbc_set_texte', 'Clique ici'));

            $lien = esc_url(get_option('wp_dbc_set_option_1_link', ''));
    
            // Position CSS selon l'option choisie
            $positions = [
                'bottom-right' => 'bottom: 20px; right: 20px;',
                'bottom-left' => 'bottom: 20px; left: 20px;',
                'top-right' => 'top: 20px; right: 20px;',
                'top-left' => 'top: 20px; left: 20px;',
            ];
            $style = isset($positions[$position]) ? $positions[$position] : $positions['bottom-right'];
    
            echo "
            <style>
                .wp-donate-button-custom-bouton {
                    position: fixed;
                    $style
                    z-index: 1000; /* min z-index 888 */
                    padding: 12px 24px;
                    background: $couleur;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: transform 0.3s ease, background-color 0.3s ease;
                    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
                    text-decoration: none;
                }
                .wp-donate-button-custom-bouton:hover {
                    transform: scale(1.1);
                }
            </style>
            <a href=\"$lien\" class=\"wp-donate-button-custom-bouton\">
                " . ($icone ? "<span class='dashicons $icone' style='margin-right:8px; vertical-align:middle;'></span>" : "") . "
                $texte
            </a>
            ";
        }
    }
    
    /**
     * Enqueue the button styles
     */
    function wp_donate_button_custom_enqueue_styles() {
        // Enqueue the button styles
        wp_enqueue_style( 'wp-donate-button-custom-styles', plugin_dir_url( __FILE__ ) . 'assets/css/wp-donate-button-custom.css');
    }
    
    /**
     * Enqueue the button scripts
     */
    function wp_donate_button_custom_enqueue_scripts() {
        // Enqueue the button scripts
        wp_enqueue_script( 'wp-donate-button-custom-scripts', plugin_dir_url( __FILE__ ) . 'assets/js/wp-donate-button-custom.js', array( 'jquery' ), null, true );
    }