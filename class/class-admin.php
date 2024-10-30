<?php 
defined( 'ABSPATH' ) or die;

if ( ! class_exists( 'imageswp_Admin_Class' ) ) {
	class imageswp_Admin_Class {
		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private static $instance = null;

		private function __clone() { }

		public function __wakeup() { }

		private function __construct() {
			// WP Hooks
			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_action( 'admin_menu', array( $this, 'add_media_submenu_item' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		}

		public function register_settings() {
            register_setting( IMAGESWP_OPTSGROUP_NAME, IMAGESWP_OPTIONS_NAME, array( $this, 'sanitize_options' ) );
        }

		public function add_media_submenu_item() {
			add_submenu_page(
				'upload.php',
				__( 'imageswp', 'imageswp' ),
				__( 'imageswp', 'imageswp' ),
				'manage_options',
				'imageswp-options',
				array( $this, 'add_options_page' )
			);
		}

		public function add_options_page() {
			require IMAGESWP_VIEW_PATH . 'options.php';
		}

		public function enqueue_admin_assets() {
			wp_enqueue_style( 'imageswp-admin', plugins_url( 'css/admin.css', IMAGESWP_FILE ), array( 'thickbox' ), IMAGESWP_VER, 'all' );
			wp_enqueue_script( 'imageswp-admin', plugins_url( 'js/admin.js', IMAGESWP_FILE ), array( 'jquery', 'thickbox' ), IMAGESWP_VER, true );
			wp_localize_script( 'imageswp-admin', 'imageswpAdminData', array(
				'ajaxUrl' => admin_url( 'admin-ajax.php?action=imageswp_import' ),
				'apiKey' => imageswp_get_option( 'api_key' ),
				'apiUrl' => IMAGESWP_API_URL,
				'nonceName' => IMAGESWP_NONCE_NAME,
				'nonce' => wp_create_nonce( IMAGESWP_NONCE_BN ),
				'modalContent' => $this->get_modal_content(),
				'i18n' => array(
					'errorNS' => __( 'Network/Server error', 'imageswp' ),
					'importImg' => __( 'Import this image', 'imageswp' )
				)
			) );
		}

		private function get_modal_content() {
			ob_start();
			require IMAGESWP_VIEW_PATH . 'thickbox-btn.php';
			return ob_get_clean();
		}
	}
}