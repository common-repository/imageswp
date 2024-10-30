<?php 
defined( 'ABSPATH' ) or die;

if ( ! class_exists( 'imageswp_Ajax_Class' ) ) {
	class imageswp_Ajax_Class {
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
			add_action( 'wp_ajax_imageswp_import', array( $this, 'ajax_import' ) );
		}

		public function ajax_import() {
			if ( empty( $_POST[IMAGESWP_NONCE_NAME]) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST[IMAGESWP_NONCE_NAME] ) ), IMAGESWP_NONCE_BN ) ) {
				wp_send_json_error( __( 'Invalid request', 'imageswp' ) );
			}

			if ( empty( $_POST['img'] ) ) {
				wp_send_json_error( __( 'Empty image URL', 'imageswp' ) );
			}

			$img = sanitize_text_field( wp_unslash( $_POST['img'] ) );
			$file_name = basename( $img );
			if ( empty( $file_name ) ) {
				$file_name = md5( microtime( true ) );
			}

			$fc = wp_remote_get( $img );
			if ( is_wp_error( $fc ) ) {
				wp_send_json_error( __( 'Error while downloading image', 'imageswp' ) );
			}

			$upload = wp_upload_bits( $file_name, null, $fc['body'] );

			if ( $upload['error'] !== false ) {
				wp_send_json_error( $upload['error'] );
			}

			$attachment = array(
				'post_mime_type' => $upload['type'],
				'post_title' => $file_name,
				'post_content' => '',
				'post_status' => 'inherit'
			);

			$attach_id = wp_insert_attachment( $attachment, $upload['file'] );

			$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );

			wp_update_attachment_metadata( $attach_id, $attach_data );

			wp_send_json_success();
		}
	}
}