<?php defined( 'ABSPATH' ) or die; ?>
<a class="page-title-action imageswp-button thickbox" href="#TB_inline?height=80%&amp;width=80%&amp;inlineId=imageswp_popup"><?php esc_html_e( 'Generate image with imageswp', 'imageswp' ); ?></a>
<div id="imageswp_popup" style="display:none">
	<div class="imageswp-wrap">
		<h3><?php esc_html_e( 'Generate image with imageswp', 'imageswp' ); ?></h3>
		<form>
			<div class="imageswp-fieldset">
				<textarea name="prompt" placeholder="<?php esc_attr_e( 'Your prompt here, e.g: A woman sitting in a luxurious high-rise apartment overlooking the Nile River in Egypt', 'imageswp' ); ?>"></textarea>
			</div>
			<div class="imageswp-fieldset">
				<a class="button button-secondary imageswp-gen" href="#"><?php esc_html_e( 'Generate Image', 'imageswp' ); ?></a>
			</div>
			<div class="imageswp-fieldset imageswp-ajax-loader-api">
				<div class="imageswp-loader"></div>
			</div>
			<div class="imageswp-fieldset imageswp-results"></div>
		</form>
	</div>
</div>
