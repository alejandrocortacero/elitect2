<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import from Joomla', EpointPersonalTrainer::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<p><a class="button button-primary" href="<?php echo $page_slug . '&action=food'; ?>"><?php echo esc_html( __( 'Import food', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></a></p>
	<p><a class="button button-primary" href="<?php echo $page_slug . '&action=diets'; ?>"><?php echo esc_html( __( 'Import diets', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></a></p>
	<p><a class="button button-primary" href="<?php echo $page_slug . '&action=exercises'; ?>"><?php echo esc_html( __( 'Import exercises', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></a></p>
</div>
