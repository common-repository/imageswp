<?php
/*
Plugin Name: imageswp
Description: Free Ai Image Generator in WordPress! Create 100% unique Ai Images inside Wordpress - Free Ai Photo Generator. Works with the Media Library, Gutenberg, and other popular page builders. Just grab a free api key and generate ai images.
Version:     1.1.1
Author:      imageswp
Author URI:  https://www.imageswp.com
Text Domain: imageswp
Domain Path: /languages
License:     GPLv2 or later
*/

defined( 'ABSPATH' ) or die;

define( 'IMAGESWP_FILE', __FILE__ );
define( 'IMAGESWP_NONCE_NAME', 'wp_media_generator_ai_nonce' );
define( 'IMAGESWP_NONCE_BN', basename( __FILE__ ) );
define( 'IMAGESWP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'IMAGESWP_CLASS_PATH', IMAGESWP_PLUGIN_PATH . 'class' . DIRECTORY_SEPARATOR );
define( 'IMAGESWP_VIEW_PATH', IMAGESWP_PLUGIN_PATH . 'view' . DIRECTORY_SEPARATOR );
define( 'IMAGESWP_OPTSGROUP_NAME', 'imageswp_optsgroup' );
define( 'IMAGESWP_OPTIONS_NAME', 'imageswp_options' );
define( 'IMAGESWP_API_URL', 'https://www.ipic.ai/api/generation/text2image' );
define( 'IMAGESWP_VER', '1.1.0' );

add_action( 'init', 'imageswp_init' );
function imageswp_init() {
	load_plugin_textdomain( 'imageswp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

require_once( IMAGESWP_PLUGIN_PATH . 'functions.php' );

require_once( IMAGESWP_CLASS_PATH . 'class-admin.php' );
imageswp_Admin_Class::get_instance();

require_once( IMAGESWP_CLASS_PATH . 'class-ajax.php' );
imageswp_Ajax_Class::get_instance();