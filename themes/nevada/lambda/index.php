<?php
/*
Plugin Name: OptionTree enhanced by UnitedThemes
Plugin URI: http://wp.envato.com
Description: Customizable WordPress Theme Options Admin Interface
Version: 2.0
Author: Derek Herman
Author URI: http://valendesigns.com
Enhanced by UnitedThemes
Author: Matthias Nettekoven
License: GPLv2
*/

/**
 * Definitions
 *
 * @since 1.0.0
 */

define( 'OT_VERSION', '2' );
define( 'OT_PLUGIN_DIR', get_template_directory() . '/lambda' );
define( 'OT_PLUGIN_URL', THEME_WEB_ROOT . '/lambda' );

/**
 * Required Files
 *
 * @since 1.0.0
 */

require_once( OT_PLUGIN_DIR . '/functions/functions.load.php' );
require_once( OT_PLUGIN_DIR . '/classes/class.admin.php' );

/**
 * Instantiate Classe
 *
 * @since 1.0.0
 */
$ot_admin = new OT_Admin();

/**
 * Wordpress Activate/Deactivate
 *
 * @uses register_activation_hook()
 * @uses register_deactivation_hook()
 *
 * @since 1.0.0
 */
 
register_activation_hook( __FILE__, array( $ot_admin, 'option_tree_activate' ) );
register_deactivation_hook( __FILE__, array( $ot_admin, 'option_tree_deactivate' ) );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
add_action( 'init', array( $ot_admin, 'create_option_post' ), 5 );
add_action( 'admin_init', array( $ot_admin, 'option_tree_init' ) );
add_action( 'admin_menu', array( $ot_admin, 'option_tree_admin' ) );

/**
 * Required plugins
 */

require_once( OT_PLUGIN_DIR . '/tablemanager/index.php' );
require_once( OT_PLUGIN_DIR . '/themeupdater/index.php' );

/* All the AJAX to run OT */
add_action( 'wp_ajax_option_tree_array_save', array( $ot_admin, 'option_tree_array_save' ) );
add_action( 'wp_ajax_option_tree_array_reload', array( $ot_admin, 'option_tree_array_reload' ) );
add_action( 'wp_ajax_option_tree_array_reset', array( $ot_admin, 'option_tree_array_reset' ) );
add_action( 'wp_ajax_option_tree_add', array( $ot_admin, 'option_tree_add' ) );
add_action( 'wp_ajax_option_tree_edit', array( $ot_admin, 'option_tree_edit' ) );
add_action( 'wp_ajax_option_tree_delete', array( $ot_admin, 'option_tree_delete' ) );
add_action( 'wp_ajax_option_tree_next_id', array( $ot_admin, 'option_tree_next_id' ) );
add_action( 'wp_ajax_option_tree_sort', array( $ot_admin, 'option_tree_sort' ) );
add_action( 'wp_ajax_option_tree_import_data', array( $ot_admin, 'option_tree_import_data' ) );
add_action( 'wp_ajax_option_tree_update_export_data', array( $ot_admin, 'option_tree_update_export_data' ) );
add_action( 'wp_ajax_option_tree_add_slider', array( $ot_admin, 'option_tree_add_slider' ) );
add_action( 'wp_ajax_option_tree_add_font', array( $ot_admin, 'option_tree_add_font' ) );
add_action( 'wp_ajax_option_tree_add_social', array( $ot_admin, 'option_tree_add_social' ) );
add_action( 'wp_ajax_option_tree_add_clients', array( $ot_admin, 'option_tree_add_clients' ) );
add_action( 'wp_ajax_option_tree_add_sidebar', array( $ot_admin, 'option_tree_add_sidebar' ) );
add_action( 'wp_ajax_option_tree_save_layout', array( $ot_admin, 'option_tree_save_layout' ) );
add_action( 'wp_ajax_option_tree_delete_layout', array( $ot_admin, 'option_tree_delete_layout' ) );
add_action( 'wp_ajax_option_tree_activate_layout', array( $ot_admin, 'option_tree_activate_layout' ) );
add_action( 'wp_ajax_option_tree_import_layout', array( $ot_admin, 'option_tree_import_layout' ) );
add_action( 'wp_ajax_option_tree_update_export_layout', array( $ot_admin, 'option_tree_update_export_layout' ) );

/* Add Use profile info to turn on/off docs in end-user mode */
if( apply_filters( 'nevada_show_ot_docs_in_profile' , true ) ) {
    add_action( 'show_user_profile', array( $ot_admin, 'option_tree_extra_profile_fields' ) );
    add_action( 'edit_user_profile', array( $ot_admin, 'option_tree_extra_profile_fields' ) );
}
add_action( 'personal_options_update', array( $ot_admin, 'option_tree_save_extra_profile_fields' ) );
add_action( 'edit_user_profile_update', array( $ot_admin, 'option_tree_save_extra_profile_fields' ) );

/* Save custom CSS options */
add_action( 'option_tree_array_save', 'option_tree_css_save', 5 );