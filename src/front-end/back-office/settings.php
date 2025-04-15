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
     * The content of the admin page
     */
    function  wp_donate_button_custom_page_admin() {
        // Check if the user has the ability to view the page
        if (current_user_can(WP_DBC_CAPABILITY)) {
            ?>
            <div class="wrap">
                <style>
                    .wp-donate-button-custom-container h3{ font-size: 15px; }
                    .wp-donate-button-custom-container h4{ font-size: 13px; }
                    .wp-donate-button-custom-container .wp-donate-button-custom-box{
                        margin: 1rem 0;
                        padding: 5px 20px;
                        background: #fff;
                        border: 1px solid #ccc;
                        border-radius: 8px;
                        max-width: 100%;
                    }
                    .wp-donate-button-custom-container .wp-donate-button-custom-submit{
                        margin: 0;
                        padding: 0;
                    }
                    .wp-donate-button-custom-container .submit{
                        display: contents;
                    }
                </style>

                <h1>Réglages de <?php echo WP_DBC_NAME; ?></h1>

                <!-- Message de succès -->
                <?php if (isset($_GET['settings-updated'])) { ?>
                    <div class="notice notice-success is-dismissible">
                        <p><?php _e('Les réglages ont été enregistrés.', 'mon-plugin'); ?></p>
                    </div>
                <?php } ?>

                <!-- Contenu de la page -->
                <div class="wrap wp-donate-button-custom-container">
                    <form method="post" action="options.php">
                        <?php settings_fields('wp_dbc_options_group'); ?>

                        <h2>Description du module</h2>
                        <div class="wp-donate-button-custom-box">
                            <p>
                                Ce bouton s'affiche uniquement sur les pages vitrines.
                                <br/>Il est possible de personnaliser le texte, le lien, la couleur, l'icône et la position du bouton.
                            </p>    
                        </div>

                        <h2>Configuration du thème</h2>
                        <div class="wp-donate-button-custom-box">
                            <p>Zone de configuration des composants thème du bouton de don.</p>
                            <?php do_settings_sections('wp-donate-button-custom-apparence'); ?>
                        </div>

                        <h2>Configuration des informations</h2>
                        <div class="wp-donate-button-custom-box">
                            <p>Zone de configuration des composants informations du bouton de don.</p>
                            <?php do_settings_sections('wp-donate-button-custom-contenu'); ?>
                        </div>

                        <h2>Configuration des boutons d'actions</h2>
                        <div class="wp-donate-button-custom-box">
                            <p>Zone de configuration des composants actions du bouton de don.</p>
                            <?php do_settings_sections('wp-donate-button-custom-options'); ?>
                            <h4><u>→ Option 1</u></h4>
                            <?php do_settings_sections('wp-donate-button-custom-option-1'); ?>
                            <h4><u>→ Option 2</u></h4>
                            <?php do_settings_sections('wp-donate-button-custom-option-2'); ?>
                            <h4><u>→ Option 3</u></h4>
                            <?php do_settings_sections('wp-donate-button-custom-option-3'); ?>
                            <h4><u>→ Option 4</u></h4>
                            <?php do_settings_sections('wp-donate-button-custom-option-4'); ?>
                        </div>
                        <p class="wp-donate-button-custom-submit">
                            <!-- Enregistrer les réglages -->
                            <?php submit_button(); ?>
                            <!-- Réinitialiser les réglages -->
                            <a href="<?php echo esc_url(admin_url('options-general.php?page=wp-donate-button-custom&reset=true')); ?>">
                                <button type="button" class="button button-secondary">Réinitialiser les réglages</button>
                            </a>
                            <!-- Vider les champs -->
                            <input type="button" class="button button-secondary" onClick="wpMonBoutonVitrineTestClear()" value="<?php _e('Vider tous les champs', 'mon-plugin'); ?>"/>
                            <!-- Annuler (retour arrière) -->
                            <input type="reset" class="button button-secondary" onClick="wpMonBoutonVitrineTestReset()" value="<?php _e('Annuler', 'mon-plugin'); ?>"/>
                        </p>
                    </form>
                </div>
            </div>
            <?php
        } else {
            wp_die(__('Vous n\'avez pas l\'autorisation d\'accéder à cette page.', 'mon-plugin'));
        }
    }
    // Initialiser les réglages - link with wp_donate_button_custom_page_admin
    function wp_donate_button_custom_page_admin_init(){
        // - section 1
        register_setting('wp_dbc_options_group', 'wp_dbc_set_visibility');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_color');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_position');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_effect');
        // - section 2
        register_setting('wp_dbc_options_group', 'wp_dbc_set_icone_type');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_icone_wp_dash');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_icone_wp_media');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_texte');
        // - section 3
        register_setting('wp_dbc_options_group', 'wp_dbc_set_options_number'); // select => nb : min 1 - max 4
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_1_title');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_1_link');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_2_title');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_2_link');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_3_title');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_3_link');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_4_title');
        register_setting('wp_dbc_options_group', 'wp_dbc_set_option_4_link');

        // === Section : Apparence du bouton ===
        add_settings_section('wp_dbc_section_apparence', '', null, 'wp-donate-button-custom-apparence');
        // visibility
        add_settings_field(
            'wp_dbc_set_visibility',
            'Visibilité du bouton',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_visibility', 'true'));
                $checked = checked($val, 'true', false);
                echo "<label><input type='checkbox' name='wp_dbc_set_visibility' value='true' $checked /> Afficher le bouton</label>";
            },
            'wp-donate-button-custom-apparence',
            'wp_dbc_section_apparence'
        );
        // color
        add_settings_field(
            'wp_dbc_set_color',
            'Couleur du bouton',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_color', '#0073aa'));
                echo "<input type='color' name='wp_dbc_set_color' value='$val' />";
            },
            'wp-donate-button-custom-apparence',
            'wp_dbc_section_apparence'
        );
        // position
        add_settings_field(
            'wp_dbc_set_position',
            'Position du bouton',
            function () {
                $val = get_option('wp_dbc_set_position', 'bottom-right');
                $options = [
                    'bottom-right' => 'En bas à droite',
                    'bottom-left'  => 'En bas à gauche',
                    'top-right'    => 'En haut à droite',
                    'top-left'     => 'En haut à gauche',
                ];
                echo "<select name='wp_dbc_set_position'>";
                foreach ($options as $key => $label) {
                    $selected = selected($val, $key, false);
                    echo "<option value='$key' $selected>$label</option>";
                }
                echo "</select>";
            },
            'wp-donate-button-custom-apparence',
            'wp_dbc_section_apparence'
        );
        // effect
        add_settings_field(
            'wp_dbc_set_effect',
            'Effet du bouton',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_effect', 'hover_medium'));
                $options = [
                    'none' => 'Aucune',
                    'hover_speed' => 'Survol rapide',
                    '' => 'Survol moyen',
                    'hover_slow' => 'Survol lent',
                ];
                echo "<select name='wp_dbc_set_effect'>";
                foreach ($options as $key => $label) {
                    $selected = selected($val, $key, false);
                    echo "<option value='$key' $selected>$label</option>";
                }
                echo "</select>";
            },
            'wp-donate-button-custom-apparence',
            'wp_dbc_section_apparence'
        );

        // === Section : Contenu du bouton ===
        add_settings_section('wp_dbc_section_contenu', '', null, 'wp-donate-button-custom-contenu');
        // wp_dbc_set_icone_type - button radio beetween dashicon ou a wp media loaded
        add_settings_field(
            'wp_dbc_set_icone_type',
            'Type d\'icône',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_icone_type', 'icone_wp_dash'));
                $options = [
                    'icone_wp_dash' => 'Icône Dashicon',
                    'icone_wp_media' => 'Icône WP Media',
                ];
                foreach ($options as $key => $label) {
                    $checked = checked($val, $key, false);
                    echo "<label><input type='radio' name='wp_dbc_set_icone_type' value='$key' $checked /> $label</label><br />";
                }
            },
            'wp-donate-button-custom-contenu',
            'wp_dbc_section_contenu'
        );
        // wp_dbc_set_icone_wp_dash
        add_settings_field(
            'wp_dbc_set_icone_wp_dash',
            'Classe Dashicon',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_icone_wp_dash', 'heart'));
                $options = [
                    'none' => 'Aucune',
                    'dashicons-admin-site' => 'dashicons-admin-site',
                    'dashicons-admin-general' => 'dashicons-admin-generic',
                    'dashicons-admin-users' => 'dashicons-admin-users',
                    'dashicons-donwload' => 'dashicons-download',
                    'dashicons-calendar' => 'dashicons-calendar',
                    'dashicons-heart' => 'dashicons-heart',
                    'dashicons-home' => 'dashicons-home',
                ];
                echo "<select name='wp_dbc_set_icone_wp_dash'>";
                foreach ($options as $key => $label) {
                    $selected = selected($val, $key, false);
                    echo "<option value='$key' $selected>$label</option>";
                }
                echo "</select>";
                echo "<p class='description'><a href='https://developer.wordpress.org/resource/dashicons/' target='_blank'>Voir les icônes disponibles</a></p>";
            },
            'wp-donate-button-custom-contenu',
            'wp_dbc_section_contenu'
        );
        // wp_dbc_set_icone_wp_media
        add_settings_field(
            'wp_dbc_set_icone_wp_media',
            'Icône WP Media',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_icone_wp_media', ''));
                echo '<input type="text" name="wp_dbc_set_icone_wp_media" id="wp_dbc_set_icone_wp_media" value="'.$val.'" class="regular-text" placeholder="URL de l\'icône" />';
                echo "<p class='description'>Téléchargez une image dans la bibliothèque de médias et copiez l'URL ici.</p>";
            },
            'wp-donate-button-custom-contenu',
            'wp_dbc_section_contenu'
        );
        // wp_dbc_set_texte
        add_settings_field(
            'wp_dbc_set_texte',
            'Texte du bouton',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_texte', 'Soutenez nous !'));
                echo "<input type='text' name='wp_dbc_set_texte' value='$val' class='regular-text' />";
            },
            'wp-donate-button-custom-contenu',
            'wp_dbc_section_contenu'
        );

        // === Section : Lien du bouton ===
        add_settings_section('wp_dbc_section_options', '', null, 'wp-donate-button-custom-options');
        // wp_dbc_set_options_number
        add_settings_field(
            'wp_dbc_set_options_number',
            'Nombre de boutons d\'actions',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_options_number', 1));
                $options = range(1, 4);
                echo "<select name='wp_dbc_set_options_number'>";
                foreach ($options as $option) {
                    $selected = selected($val, $option, false);
                    echo "<option value='$option' $selected>$option</option>";
                }
                echo "</select>";
            },
            'wp-donate-button-custom-options',
            'wp_dbc_section_options'
        );
        // => option 1
        add_settings_section('wp_dbc_section_option_1', '', null, 'wp-donate-button-custom-option-1');
        // wp_dbc_set_option_1_title
        add_settings_field(
            'wp_dbc_set_option_1_title',
            'Titre du bouton d\'action 1',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_option_1_title', ''));
                echo '<input type="text" name="wp_dbc_set_option_1_title" value="'.$val.'" class="regular-text" placeholder="Titre du bouton d\'action 1" />';
            },
            'wp-donate-button-custom-option-1',
            'wp_dbc_section_option_1'
        );
        // wp_dbc_set_option_1_link
        add_settings_field(
            'wp_dbc_set_option_1_link',
            'Lien du bouton d\'action 1',
            function () {
                $val = esc_url(get_option('wp_dbc_set_option_1_link', ''));
                echo '<input type="url" name="wp_dbc_set_option_1_link" value="'.$val.'" class="regular-text" placeholder="URL du bouton d\'action 1" />';
            },
            'wp-donate-button-custom-option-1',
            'wp_dbc_section_option_1'
        );
        // => option 2
        add_settings_section('wp_dbc_section_option_2', '', null, 'wp-donate-button-custom-option-2');
        // wp_dbc_set_option_2_title
        add_settings_field(
            'wp_dbc_set_option_2_title',
            'Titre du bouton d\'action 2',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_option_2_title', ''));
                echo '<input type="text" name="wp_dbc_set_option_2_title" value="'.$val.'" class="regular-text" placeholder="Titre du bouton d\'action 2" />';
            },
            'wp-donate-button-custom-option-2',
            'wp_dbc_section_option_2'
        );
        // wp_dbc_set_option_2_link
        add_settings_field(
            'wp_dbc_set_option_2_link',
            'Lien du bouton d\'action 2',
            function () {
                $val = esc_url(get_option('wp_dbc_set_option_2_link', ''));
                echo '<input type="url" name="wp_dbc_set_option_2_link" value="'.$val.'" class="regular-text" placeholder="URL du bouton d\'action 2" />';
            },
            'wp-donate-button-custom-option-2',
            'wp_dbc_section_option_2'
        );
        // => option 3
        add_settings_section('wp_dbc_section_option_3', '', null, 'wp-donate-button-custom-option-3');
        // wp_dbc_set_option_3_title
        add_settings_field(
            'wp_dbc_set_option_3_title',
            'Titre du bouton d\'action 3',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_option_3_title', ''));
                echo '<input type="text" name="wp_dbc_set_option_3_title" value="'.$val.'" class="regular-text" placeholder="Titre du bouton d\'action 3" />';
            },
            'wp-donate-button-custom-option-3',
            'wp_dbc_section_option_3'
        );
        // wp_dbc_set_option_3_link
        add_settings_field(
            'wp_dbc_set_option_3_link',
            'Lien du bouton d\'action 3',
            function () {
                $val = esc_url(get_option('wp_dbc_set_option_3_link', ''));
                echo '<input type="url" name="wp_dbc_set_option_3_link" value="'.$val.'" class="regular-text" placeholder="URL du bouton d\'action 3" />';
            },
            'wp-donate-button-custom-option-3',
            'wp_dbc_section_option_3'
        );
        // => option 4
        add_settings_section('wp_dbc_section_option_4', '', null, 'wp-donate-button-custom-option-4');
        // wp_dbc_set_option_4_title
        add_settings_field(
            'wp_dbc_set_option_4_title',
            'Titre du bouton d\'action 4',
            function () {
                $val = esc_attr(get_option('wp_dbc_set_option_4_title', ''));
                echo '<input type="text" name="wp_dbc_set_option_4_title" value="'.$val.'" class="regular-text" placeholder="Titre du bouton d\'action 4" />';
            },
            'wp-donate-button-custom-option-4',
            'wp_dbc_section_option_4'
        );
        // wp_dbc_set_option_4_link
        add_settings_field(
            'wp_dbc_set_option_4_link',
            'Lien du bouton d\'action 4',
            function () {
                $val = esc_url(get_option('wp_dbc_set_option_4_link', ''));
                echo '<input type="url" name="wp_dbc_set_option_4_link" value="'.$val.'" class="regular-text" placeholder="URL du bouton d\'action 4" />';
            },
            'wp-donate-button-custom-option-4',
            'wp_dbc_section_option_4'
        );
    }

    /**
     * The content of the info page
     */
    function wp_donate_button_custom_page_info() {
        // Check if the user has the ability to view the page
        if (current_user_can(WP_DBC_CAPABILITY)) {
            ?>
            <div class="wrap">
                <h1><?php echo WP_DBC_NAME; ?></h1>
                <hr/>
                <h2>➔ Le module : </h2>
                <p>Ce module permet de gérer des salles de classes virtuelles.
                    <br/>Il est possible de créer, modifier et supprimer des salles de classes.
                    <br/>Il est possible de gérer les utilisateurs et les rôles.
                    <br/>Il est possible de gérer les paramètres de l'application.
                </p>
                <h2>➔ Statut : </h2>
                <p>Le module est encore en développement, il est possible que des erreurs surviennent.</p>
                <h2>➔ Informations du développeur : </h2>
                <ul>
                    <li>Nom : Astek</li>
                    <li>Site : <a href="https://www.astek.fr/" target="_blank">https://www.astek.fr/</a></li>
                    <li>Adresse : 1 Rue Royale, 92210 Saint-Cloud</li>
                    <li>Téléphone : 01 41 12 37 00</li>
                </ul>
            </div>
            <?php
        } else {
            wp_die(__('Vous n\'avez pas l\'autorisation d\'accéder à cette page.', 'mon-plugin'));
        }
    }

    /**
     * The content of the info page
     */
    function wp_donate_button_custom_page_dev() {
        // Check if the user has the ability to view the page
        if (current_user_can(WP_DBC_CAPABILITY_DEV)) {
            ?>
            <div class="wrap">
                <h1><?php echo WP_DBC_NAME; ?></h1>
                <hr/>
                <h2>➔ Utiles : </h2>
                <ul>
                    <li>__FILE__ : <?php echo __FILE__; ?></li>
                    <li>__DIR__ : <?php echo __DIR__; ?></li>
                    <li>dirname(__FILE__) : <?php echo dirname( __FILE__); ?></li>
                    <li>plugin_basename(__FILE__) : <?php echo plugin_basename(__FILE__); ?></li>
                    <li>plugin_dir_path(__DIR__) : <?php echo plugin_dir_path(__DIR__); ?></li>
                    <li>plugin_dir_path(__FILE__) : <?php echo plugin_dir_path(__FILE__); ?></li>
                    <li>plugin_dir_url(__FILE__) : <?php echo plugin_dir_url(__FILE__); ?></li>
                    <li>WP_PLUGIN_DIR : <?php echo WP_PLUGIN_DIR; ?></li>
                    <li>WPMU_PLUGIN_DIR : <?php echo WPMU_PLUGIN_DIR; ?></li>
                </ul>
                <h2>➔ Constantes du module : </h2>
                <ul>
                    <li>WP_DBC_VERSION : <?php echo WP_DBC_VERSION; ?></li>
                    <li>WP_DBC_NAME : <?php echo WP_DBC_NAME; ?></li>
                    <li>WP_DBC_NAME_LITE : <?php echo WP_DBC_NAME_LITE; ?></li>
                    <li>WP_DBC_NAME_SLUG : <?php echo WP_DBC_NAME_SLUG; ?></li>
                    <li>WP_DBC_NAME_SLUG_UNDERSCORE : <?php echo WP_DBC_NAME_SLUG_UNDERSCORE; ?></li>
                    <li>WP_DBC_URL : <?php echo WP_DBC_URL; ?></li>
                    <li>WP_DBC_PATH : <?php echo WP_DBC_PATH; ?></li>
                    <li>WP_DBC_MENU_POSITION : <?php echo WP_DBC_MENU_POSITION; ?></li>
                    <li>WP_DBC_CAPABILITY : <?php echo WP_DBC_CAPABILITY; ?></li>
                    <li>WP_DBC_ROLE : <?php echo WP_DBC_ROLE; ?></li>
                    <li>WP_DBC_ROLE_NAME : <?php echo WP_DBC_ROLE_NAME; ?></li>
                </ul>
                <h2>➔ Utilisateur connecté :</h2>
                <?php var_dump(wp_get_current_user()); ?>
                <h2>➔ Rôle de l'utilisateur connecté :</h2>
                <?php var_dump(wp_get_current_user()->roles); ?>
                <h2>➔ Rôle par défaut :</h2>
                <?php var_dump(get_option('default_role')); ?>
                <h2>➔ Rôle modèle du module :</h2>
                <?php var_dump(wp_roles()->get_role(WP_DBC_ROLE)); ?>
                <h2>➔ Tous les rôles :</h2>
                <?php var_dump(wp_roles()->get_role('administrator')); ?>
            </div>
            <?php
        } else {
            wp_die(__('Vous n\'avez pas l\'autorisation d\'accéder à cette page.', 'mon-plugin'));
        }
    }