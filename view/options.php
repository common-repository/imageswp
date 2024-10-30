<?php defined( 'ABSPATH' ) or die; ?>
<div class="wrap wrap-imageswp">
	<?php settings_errors(); ?>
	<h1><?php esc_html_e( 'imageswp - Options', 'imageswp' ); ?></h1>
	<form method="post" action="options.php">
		<?php settings_fields( IMAGESWP_OPTSGROUP_NAME ); ?>
		<?php do_settings_sections( IMAGESWP_OPTSGROUP_NAME ); ?>
		<table class="form-table">
			<tr>
				<th><?php esc_html_e( 'API Key', 'imageswp' ); ?></th>
				<td>
					<input type="text" class="regular-text" name="<?php echo esc_attr( IMAGESWP_OPTIONS_NAME ); ?>[api_key]" value="<?php echo esc_attr( imageswp_get_option( 'api_key' ) ); ?>">
					<p><?php echo sprintf( esc_html( '%1$sClick here to register%2$s and get free api and click here to %3$sgenerate free api key%4$s', 'imageswp' ), '<a target="_blank" href="https://www.ipic.ai/register?utm_source=imageswp">', '</a>', '<a target="_blank" href="https://www.ipic.ai/user/settings/api-key">', '</a>' ); ?></p>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>