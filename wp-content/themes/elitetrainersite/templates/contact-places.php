<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php if( class_exists( 'JLCContact' ) ) : ?>
	<div class="centered-layer">
		<?php //get_template_part( 'templates/google', 'map' ); ?>
		<hr />
		<?php $addresses_list = JLCContact::get_contact_addresses_list(); ?>
		<div class="phone-layer">
		<?php if( empty( $addresses_list ) ) : ?>
			<?php echo JLCContact::get_contact_phone_link( sprintf( '<h3 class="text-center">%s</h3><h3 class="text-center phone"><span class="glyphicon glyphicon-earphone"></span> {phone}</h3>', __( 'Call us', EliteTrainerSiteTheme::TEXT_DOMAIN ) ) ); ?>
		<?php else : ?>
			<?php foreach( $addresses_list as $list ) : ?>
				<h4 class="text-center"><?php echo esc_html( $list->address ); ?></h4>
				<h4 class="text-center"><?php echo esc_html( $list->city ); ?>, <?php echo esc_html( $list->state ); ?> <?php echo esc_html( $list->postcode ); ?></h4>
				<a href="tel:<?php echo $list->phone; ?>" rel="nofollow"><h3 class="text-center phone"><span class="glyphicon glyphicon-earphone"></span> <?php echo $list->phone; ?></h3></a>
				<a href="mailto:<?php echo $list->email; ?>" rel="nofollow"><h3 class="text-center phone"><span class="glyphicon glyphicon-envelope"></span> <?php echo $list->email; ?></h3></a>
				<hr />
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

