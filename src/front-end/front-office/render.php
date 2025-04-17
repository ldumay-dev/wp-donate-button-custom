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


            $wp_dbc_set_visibility = get_option('wp_dbc_set_visibility', 'true');
            $wp_dbc_set_font_family = get_option('wp_dbc_set_font_family', 'Arial, sans-serif');
            $wp_dbc_set_font_style = get_option('wp_dbc_set_font_style', 'normal');
            $wp_dbc_set_font_weight = get_option('wp_dbc_set_font_weight', 'bold');
            $wp_dbc_set_font_size = get_option('wp_dbc_set_font_size', '1.1em');
            $wp_dbc_set_color_background = esc_attr(get_option('wp_dbc_set_color_background', '#0073aa'));
            $wp_dbc_set_color_box_shadow_color = esc_attr(get_option('wp_dbc_set_color_box_shadow_color', '#0073aa'));
            $wp_dbc_set_color_box_shadow_opacity = esc_attr(get_option('wp_dbc_set_color_box_shadow_opacity', '0.5'));
            $wp_dbc_set_color_box_shadow = wp_donate_button_custom_hex2rgba($wp_dbc_set_color_box_shadow_color, $wp_dbc_set_color_box_shadow_opacity);
            $wp_dbc_set_surposition = get_option('wp_dbc_set_surposition', '100000000');
            $wp_dbc_set_position = get_option('wp_dbc_set_position', 'bottom-right');
            $wp_dbc_set_effect = get_option('wp_dbc_set_effect', 'hover_medium');
            $wp_dbc_set_icone_type = get_option('wp_dbc_set_icone_type', 'icone_wp_dash');
            $wp_dbc_set_icone_wp_dash = esc_attr(get_option('wp_dbc_set_icone_wp_dash', 'dashicons-heart'));
            $wp_dbc_set_icone_wp_media = esc_attr(get_option('wp_dbc_set_icone_wp_media', 'https://www.la-spa.fr/app/app/uploads/2021/09/highlightFichier-2@2x.png'));
            $wp_dbc_set_texte = esc_html(get_option('wp_dbc_set_texte', 'Ceci est un bouton de don'));
            $wp_dbc_set_options_number = get_option('wp_dbc_set_options_number', 2);
            $wp_dbc_set_option_1_title = esc_html(get_option('wp_dbc_set_option_1_title', 'Option 1'));
            $wp_dbc_set_option_1_link = esc_url(get_option('wp_dbc_set_option_1_link', 'https://example.com'));
            $wp_dbc_set_option_2_title = esc_html(get_option('wp_dbc_set_option_2_title', 'Option 2'));
            $wp_dbc_set_option_2_link = esc_url(get_option('wp_dbc_set_option_2_link', 'https://example.com'));
            $wp_dbc_set_option_3_title = esc_html(get_option('wp_dbc_set_option_3_title', 'Option 3'));
            $wp_dbc_set_option_3_link = esc_url(get_option('wp_dbc_set_option_3_link', 'https://example.com'));
            $wp_dbc_set_option_4_title = esc_html(get_option('wp_dbc_set_option_4_title', 'Option 4'));
            $wp_dbc_set_option_4_link = esc_url(get_option('wp_dbc_set_option_4_link', 'https://example.com'));

            // var_dump($wp_dbc_set_visibility, 
            //     $wp_dbc_set_font_family, $wp_dbc_set_font_style, $wp_dbc_set_font_weight, $wp_dbc_set_font_size,
            //     $wp_dbc_set_color_background, $wp_dbc_set_color_box_shadow_color, $wp_dbc_set_color_box_shadow_opacity, $wp_dbc_set_color_box_shadow,
            //     $wp_dbc_set_surposition, $wp_dbc_set_position, $wp_dbc_set_effect, 
            //     $wp_dbc_set_icone_type, $wp_dbc_set_icone_wp_dash, $wp_dbc_set_icone_wp_media, $wp_dbc_set_texte, 
            //     $wp_dbc_set_options_number, 
            //     $wp_dbc_set_option_1_title, $wp_dbc_set_option_1_link, $wp_dbc_set_option_2_title, $wp_dbc_set_option_2_link, 
            //     $wp_dbc_set_option_3_title, $wp_dbc_set_option_3_link, $wp_dbc_set_option_4_title, $wp_dbc_set_option_4_link
            // );

            // Position CSS selon l'option choisie
            $wp_dbc_set_positions = [
                'bottom-right' => 'bottom: 20px; right: 20px;',
                'bottom-left' => 'bottom: 20px; left: 20px;',
                'top-right' => 'top: 20px; right: 20px;',
                'top-left' => 'top: 20px; left: 20px;',
            ];
            $wp_dbc_set_style = isset($wp_dbc_set_positions[$wp_dbc_set_position]) ? $wp_dbc_set_positions[$wp_dbc_set_position] : $wp_dbc_set_positions['bottom-right'];

            if($wp_dbc_set_visibility == 'true'){
                echo "
                <!-- Bouton de don -->
                <div class='donate-button'>
                    <!-- Bouton principal -->
                    <div class='main-button'>
                        <button>";
                            if($wp_dbc_set_icone_type != 'none'){
                                echo "
                                <span class='icon-container'>
                                    ";
                                    // Afficher l'icône selon le type choisi
                                    if($wp_dbc_set_icone_type == 'icone_wp_dash' && $wp_dbc_set_icone_wp_dash == 'dashicons-heart'){
                                        echo "<span class='dashicons $wp_dbc_set_icone_wp_dash' style='margin-right:8px; vertical-align:middle;'></span>";
                                    }
                                    if($wp_dbc_set_icone_type == 'icone_wp_media' && $wp_dbc_set_icone_wp_media != ''){
                                        echo "<img class='icon' alt='icon' src='$wp_dbc_set_icone_wp_media'/>";
                                    }
                                    echo "
                                </span>
                                ";
                            }
                            echo "
                            <span class='donate-text'>$wp_dbc_set_texte</span>
                        </button>
                    </div>
                    <!-- Boutons supplémentaires -->
                    <div class='additional-buttons'>
                        ";
                        // Afficher les boutons supplémentaires en fonction du nombre d'options
                        if ($wp_dbc_set_options_number >= 1) {
                            echo "<a href='$wp_dbc_set_option_1_link' target='_blank'>
                                <button class='additional-button' id='button-one'>$wp_dbc_set_option_1_title</button>
                            </a>";
                        }
                        if ($wp_dbc_set_options_number >= 2) {
                            echo "<a href='$wp_dbc_set_option_2_link' target='_blank'>
                                <button class='additional-button' id='button-one'>$wp_dbc_set_option_2_title</button>
                            </a>";
                        }
                        if ($wp_dbc_set_options_number >= 3) {
                            echo "<a href='$wp_dbc_set_option_3_link' target='_blank'>
                                <button class='additional-button' id='button-one'>$wp_dbc_set_option_3_title</button>
                            </a>";
                        }
                        if ($wp_dbc_set_options_number >= 4) {
                            echo "<a href='$wp_dbc_set_option_4_link' target='_blank'>
                                <button class='additional-button' id='button-one'>$wp_dbc_set_option_4_title</button>
                            </a>";
                        }
                        echo "
                    </div>
                </div>";
                // Styles CSS
                echo "
                <style>
                    /* Bouton de don */
                    .donate-button button:hover {
                        opacity: 1;
                    }
                    
                    .donate-button, .donate-button .main-button button{
                        font-family: $wp_dbc_set_font_family; /* Police de caractères selon l'option choisie */
                        font-style: $wp_dbc_set_font_style; /* Style de la police selon l'option choisie */
                        font-weight: $wp_dbc_set_font_weight; /* Poids de la police selon l'option choisie */
                        font-size: $wp_dbc_set_font_size; /* Taille de la police selon l'option choisie */
                    }

                    .donate-button, .donate-button .main-button button, .donate-button .additional-button{
                        padding: 8px 8px;
                    }

                    .donate-button, .donate-button .main-button button, .donate-button .additional-button {
                        color: white;
                    }

                    .donate-button {
                        $wp_dbc_set_style /* Position CSS selon l'option choisie */
                        background-color: $wp_dbc_set_color_background; /* Couleur de fond selon l'option choisie */
                        box-shadow: 4px 4px 10px $wp_dbc_set_color_box_shadow; /* Ombre selon l'option choisie */
                    }

                    .donate-button {
                        position: fixed;
                        z-index: $wp_dbc_set_surposition; /* min z-index 888 pour WordPress */
                        display: flex;
                        gap: 10px;
                        border: none;
                        border-radius: 8px;
                        backdrop-filter: blur(5px);
                        cursor: pointer;
                        transition: transform 0.10s ease;
                    }

                    /* Style principal du bouton de don */
                    .donate-button .main-button button {
                        display: flex;
                        gap: 10px;
                        background-color: transparent;
                        border: none;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .donate-button .main-button .icon {
                        width: 24px;
                        height: 24px;
                    }

                    .donate-button .main-button .donate-text {
                        white-space: nowrap;
                    }

                    /* Style pour les boutons supplémentaires */
                    .donate-button .additional-buttons {
                        display: none;
                        gap: 10px;
                        top: 100%;
                        left: 0;
                        right: 0;
                        opacity: 0;
                        visibility: hidden;
                        transition: opacity 0.3s ease, visibility 0.3s ease;
                    }

                    .donate-button:hover .additional-buttons {
                        display: flex;
                        opacity: 1;
                        visibility: visible;
                    }

                    .donate-button .additional-button {
                        background-color: transparent;
                        padding: 10px 20px;
                        border: 2px solid white;
                        border-radius: 20px;
                        text-align: center;
                        cursor: pointer;
                        transition: background-color 0.3s ease, transform 0.2s ease;
                    }

                    .donate-button .additional-button:hover {
                        background-color: rgba(255, 255, 255, 0.2);
                        transform: scale(1.05);
                    }

                    /* Tablette & mobile */
                    @media (max-width: 1024px){
                        .donate-button{
                            display: none;
                        }
                    }
                </style>";
            }
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