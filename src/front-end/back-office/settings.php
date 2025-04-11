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
                <h1><?php echo WP_DBC_NAME; ?></h1>
                <hr/>
                <style>
                    .wp_dbc_admin .wp_dbc_admin_position,
                    .wp_dbc_admin .wp_dbc_admin_effect,
                    .wp_dbc_admin .wp_dbc_admin_color,
                    .wp_dbc_admin .wp_dbc_admin_icon,
                    .wp_dbc_admin .wp_dbc_admin_title,
                    .wp_dbc_admin .wp_dbc_admin_option_1,
                    .wp_dbc_admin .wp_dbc_admin_option_2,
                    .wp_dbc_admin .wp_dbc_admin_option_3,
                    .wp_dbc_admin .wp_dbc_admin_option_4
                    {
                        padding: 1%;
                    }
                    .wp_dbc_admin .wp_dbc_admin_position input,
                    .wp_dbc_admin .wp_dbc_admin_icon input,
                    .wp_dbc_admin .wp_dbc_admin_title input,
                    .wp_dbc_admin .wp_dbc_admin_option_1 input,
                    .wp_dbc_admin .wp_dbc_admin_option_2 input,
                    .wp_dbc_admin .wp_dbc_admin_option_3 input,
                    .wp_dbc_admin .wp_dbc_admin_option_4 input{
                        width: 300px;
                    }
                    .wp_dbc_admin .wp_dbc_admin_effect select,
                    .wp_dbc_admin .wp_dbc_admin_options select{
                        width: 130px;
                    }
                </style>
                <form class="wp_dbc_admin" method="post" action="">
                    <h2><u>Configuration du thème du bouton de don</u></h2>
                    <p>Vous pouvez configurer le thème du bouton de don.</p>
                    <!-- Position button -->
                    <div class="wp_dbc_admin_position">
                        <label>
                            <strong>Position du bouton de don :</strong>
                            <select name="position">
                                <option value="top_left">En Haut à gauche</option>
                                <option value="top_right">En Haut à droite</option>
                                <option value="bottom_left" selected>En Bas à gauche</option>
                                <option value="bottom_right">En Bas à droite</option>
                            </select>
                        </label>
                    </div>
                    <!-- Effect button -->
                    <div class="wp_dbc_admin_effect">
                        <label>
                            <strong>Effet du bouton de don :</strong>
                            <select name="effect">
                                <option value="none">Aucun</option>
                                <option value="hover_speed">Survol rapide</option>
                                <option value="hover_medium" selected>Survol moyen</option>
                                <option value="hover_slow">Survol lent</option>
                            </select>
                        </label>
                    </div>
                    <!-- Color button -->
                    <div class="wp_dbc_admin_color">
                        <label>
                            <strong>Couleur du bouton de don :</strong>
                            <input type="color" name="color" value="#5bc4e6"/>
                        </label>
                    </div>
                    <h2><u>Configuration des informations du bouton de don</u></h2>
                    <p>Vous pouvez configurer les informations du bouton de don.</p>
                    <!-- Icon button -->
                    <div class="wp_dbc_admin_icon">
                        <label>
                            <strong>Icône du bouton de don :</strong>
                            <input type="text" name="icon" value="dashicons-heart"/> 
                            <a href="https://developer.wordpress.org/resource/dashicons/#universal-access" target="_blank">Icônes disponibles</a>
                        </label>
                    </div>
                    <hr>
                    <!-- Title button -->
                    <div class="wp_dbc_admin_title">
                        <label>
                            <strong>Titre du bouton de don :</strong>
                            <input type="text" name="title" value="Faire un don"/>
                        </label>
                        <br>
                        <label>
                            <strong>Contenu du bouton de don :</strong>
                            <input name="content" type="text" value="Faites un don pour soutenir notre projet !"/>
                        </label>
                    </div>
                    <h2><u>Configuration des boutons d'actions</u></h2>
                    <p>Vous pouvez configurer les boutons d'actions.</p>
                    <!-- Options number -->
                    <div class="wp_dbc_admin_options">
                        <label>
                            <strong>Nombre de boutons d'actions :</strong>
                            <select name="options_number">
                                <option value="0" selected>Aucun</option>
                                <option value="1">Un</option>
                                <option value="2" selected>Deux</option>
                                <option value="3">Trois</option>
                                <option value="4">Quatre</option>
                            </select>
                        </label>
                    </div>
                    <!-- Option 1 -->
                    <h3><u>Option 1</u></h3>
                    <div class="wp_dbc_admin_option_1">
                        <label>
                            <strong>Titre du bouton d'action 1 :</strong>
                            <input type="text" name="option_1_title" value="Titre du bouton d'action 1"/>
                        </label>
                        <br>
                        <label>
                            <strong>Contenu du bouton d'action 1 :</strong>
                            <input name="option_1_content" type="text" value="Contenu du bouton d'action 1"/>
                        </label>
                    </div>
                    <!-- Option 2 -->
                    <h3><u>Option 2</u></h3>
                    <div class="wp_dbc_admin_option_2">
                        <label>
                            <strong>Titre du bouton d'action 2 :</strong>
                            <input type="text" name="option_2_title" value="Titre du bouton d'action 2"/>
                        </label>
                        <br>
                        <label>
                            <strong>Contenu du bouton d'action 2 :</strong>
                            <input name="option_2_content" type="text" value="Contenu du bouton d'action 2"/>
                        </label>
                    </div>
                    <!-- Option 3 -->
                    <h3><u>Option 3</u></h3>
                    <div class="wp_dbc_admin_option_3">
                        <label>
                            <strong>Titre du bouton d'action 3 :</strong>
                            <input type="text" name="option_3_title" value="Titre du bouton d'action 3"/>
                        </label>
                        <br>
                        <label>
                            <strong>Contenu du bouton d'action 3 :</strong>
                            <input name="option_3_content" type="text" value="Contenu du bouton d'action 3"/>
                        </label>
                    </div>
                    <!-- Option 4 -->
                    <h3><u>Option 4</u></h3>
                    <div class="wp_dbc_admin_option_4">
                        <label>
                            <strong>Titre du bouton d'action 4 :</strong>
                            <input type="text" name="option_4_title" value="Titre du bouton d'action 4"/>
                        </label>
                        <br>
                        <label>
                            <strong>Contenu du bouton d'action 4 :</strong>
                            <input name="option_4_content" type="text" value="Contenu du bouton d'action 4"/>
                        </label>
                    </div>
                    <hr>
                    <!-- Save -->
                    <div class="wp_dbc_admin_save">
                        <input type="submit" class="button button-primary" value="<?php _e('Enregistrer les modifications', 'mon-plugin'); ?>"/>
                        <input type="button" class="button button-secondary" value="<?php _e('Restaurer les paramètres par défaut', 'mon-plugin'); ?>"/>
                        <input type="button" class="button button-secondary" value="<?php _e('Supprimer les paramètres', 'mon-plugin'); ?>"/>
                        <input type="reset" class="button button-secondary" value="<?php _e('Annuler', 'mon-plugin'); ?>"/>
                    </div>
                </form>
            <?php
        } else {
            wp_die(__('Vous n\'avez pas l\'autorisation d\'accéder à cette page.', 'mon-plugin'));
        }
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