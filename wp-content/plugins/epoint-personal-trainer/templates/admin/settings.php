<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( __( 'Settings', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></h1>
	<hr />
	<?php echo self::get_settings_form(); ?>
</div>
