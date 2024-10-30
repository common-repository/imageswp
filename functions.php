<?php

defined( 'ABSPATH' ) or die;

$GLOBALS[IMAGESWP_OPTIONS_NAME] = null;

function imageswp_get_option( $option_name, $default = '' ) {
	$options = $GLOBALS[IMAGESWP_OPTIONS_NAME];

	if ( is_null( $options ) ) {
		$options = ( array ) get_option( IMAGESWP_OPTIONS_NAME, array() );
	}
	if ( isset( $options[$option_name] ) ) {
		return $options[$option_name];
	}
	return $default;
}