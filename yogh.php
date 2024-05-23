<?php
/**
 * Plugin Name: Client Customization
 * Plugin URI: https://www.yogh.com.br/
 * Description: Plugins with Project Customization
 * Author: Yogh Soluções
 * Author URI: https://www.yogh.com.br/
 * Text Domain: client-customization
 * Domain Path: /languages
 * Version: 0.1.0
 *
 * @package Client_Customization
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load the plugin text domain for translation.
 */
function client_customization_load_textdomain() {
    load_plugin_textdomain( 'client-customization', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'client_customization_load_textdomain' );

/**
 * Generate the custom message to be appended to post content.
 *
 * @return string The custom message.
 */
function client_customization_get_custom_message() {
    $blog_name = get_bloginfo( 'name' );
    $blog_url  = get_bloginfo( 'url' );

    // Translators: %1$s is the blog name, %2$s is the blog URL.
    $message_text = __( 'This content is created by: %1$s (%2$s)', 'client-customization' );
    $message      = sprintf( '<p><strong>' . $message_text . '</strong></p>', $blog_name, $blog_url );

    return $message;
}

/**
 * Append the custom message to the end of post content.
 *
 * @param string $content The post content.
 *
 * @return string The modified post content with the custom message appended.
 */
function client_customization_append_message( $content ) {
    // Check if the current content is for a post (not a page or other post type).
    if ( is_singular( 'post' ) ) {
        $custom_message = client_customization_get_custom_message();
        $content       .= $custom_message;
    }

    return $content;
}
add_filter( 'the_content', 'client_customization_append_message' );

?>