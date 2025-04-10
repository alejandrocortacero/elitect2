<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php if( class_exists( 'JLCContact' ) ) : ?>
	<h2 class="text-center"><?php echo esc_html( __( 'Contact us', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
	<?php echo JLCContact::get_contact_form(); ?>
<?php endif; ?>
