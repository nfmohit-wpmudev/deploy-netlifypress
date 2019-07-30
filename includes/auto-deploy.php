<?php
/**
 * Automatic Deploy Logic
 *
 * @since      1.0
 * @package    NetlifyPress
 * @author     Nahid Ferdous Mohit
 */

/*
 * If this file is called directly, abort.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Auto Deploy Triggers
 */

if ( get_option( 'netlifypress_build_hook_url' ) ) {

    function deploy_trigger( $post_id ) {
        $post_type = get_post_type( $post_id );

        if ( in_array( $post_type, get_option( 'post_types' ) ) ) {
            wp_remote_post( esc_url( get_option( 'netlifypress_build_hook_url' ) ) );
        }
    }

    if ( in_array( 'save_update', get_option( 'action_auto_deploy' ) ) ) {
        add_action( 'save_post', 'deploy_trigger' );
    }
}
