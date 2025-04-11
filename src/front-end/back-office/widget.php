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
     * Content of the dashboard widget
     * 
     * @return void
     */
    function wp_donate_button_custom_dashboard_widget_content() {
        // Check if the user has the ability to view the page
        if (current_user_can(WP_DBC_CAPABILITY)) {
            /**
             * Accès rapides :
             * - accès au menu principale du module
             */
            echo ''
                .'<div id="'.WP_DBC_NAME_SLUG_UNDERSCORE.'widget">'
                    .'<h3><u>Bienvenue sur le widget de '.WP_DBC_NAME.'</u></h3>'
                    .'<p>Vous pouvez gérer le module depuis le menu de gauche.'
                    .'<br>Vous pouvez également accéder à la page de développement et à la page à propos.</p>'
                    .'<hr>'
                    .'<div>'
                        .'<h4><u>Statistiques</u></h4>'
                        .'<p>Nombre de survols et cliques :</p>'
                        .'<ul>'
                            .'<li>Nombre de survols du bouton de don : <strong>0</strong></li>'
                            .'<li>Nombre de boutons action : <strong>0</strong></li>'
                            .'<li>Les cliques sur les boutons action : '
                                .'<ul>'
                                    .'<li>Nombre de cliques sur "TITRE_BUTTON_ACTION_1" : <strong>0</strong></li>'
                                    .'<li>Nombre de cliques sur "TITRE_BUTTON_ACTION_2" : <strong>0</strong></li>'
                                    .'<li>Nombre de cliques sur "TITRE_BUTTON_ACTION_3" : <strong>0</strong></li>'
                                    .'<li>Nombre de cliques sur "TITRE_BUTTON_ACTION_4" : <strong>0</strong></li>'
                                .'</ul>'
                            .'</li>'
                        .'</ul>'
                    .'</div>'
                    .'<hr>'
                    .'<div>'
                        .'<h4><u>Accès Rapides</u></h4>'
                        .'<ul>'
                            .'<li><a href="'.admin_url('admin.php?page='.WP_DBC_NAME_SLUG).'">Page d\'administration</a></li>'
                            .'<li><a href="'.admin_url('admin.php?page='.WP_DBC_NAME_SLUG.'-info').'">Page à propos</a></li>'
                            .'<li><a href="'.admin_url('admin.php?page='.WP_DBC_NAME_SLUG.'-dev').'">Page de développement</a></li>'
                        .'</ul>'
                    .'</div>'
                .'</div>';
        }
    }
    
    /**
     * Add the dashboard widget
     */
    function wp_donate_button_custom_add_dashboard_widget() {
        // Check if the user has the ability to view the page
        if (current_user_can(WP_DBC_CAPABILITY)) {
            // Add the widget to the dashboard
            wp_add_dashboard_widget(
                WP_DBC_NAME_SLUG_UNDERSCORE.'_dashboard_widget', // Widget id
                WP_DBC_NAME, // Widget title
                'wp_donate_button_custom_dashboard_widget_content' // Callback function to display the widget
            );
        }
    }

    // --- [ Enablers ] ---
    // Enable the widget
    add_action('wp_dashboard_setup', 'wp_donate_button_custom_add_dashboard_widget');