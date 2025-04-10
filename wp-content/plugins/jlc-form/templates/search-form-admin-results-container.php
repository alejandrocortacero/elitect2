<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div id="<?php echo esc_attr( $id_attr ); ?>" class="jlc-search-form-results-container">
	<div class="content">
		<?php echo wp_kses_post( $content ); ?>
	</div>
	<div class="loading">
		<span class="search-waiting-clock dashicons dashicons-hourglass"></span>
	</div>
</div>
