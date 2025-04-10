<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="container-fluid contact-container">
	<div class="row">
		<div class="col-xs-12">
			<div class="container">
				<div class="col-xs-12 col-sm-6 contact-places-col">
					<?php if( class_exists( 'JLCContact' ) ) : ?>
						<?php $addresses_list = JLCContact::get_contact_addresses_list(); ?>
						<?php if( empty( $addresses_list ) ) : ?>
							<h2 class="text-center"><?php echo esc_html( __( 'Call us', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
							<div class="phone-layer">
								<?php echo JLCContact::get_contact_phone_link( sprintf( '<h3 class="text-center">%s</h3><h3 class="text-center phone"><span class="glyphicon glyphicon-earphone"></span> {phone}</h3>', __( 'Call us', PersonalTrainerTheme::TEXT_DOMAIN ) ) ); ?>
							</div>
						<?php else : ?>
							<h2 class="text-center"><?php echo esc_html( __( 'Where to find us?', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
							<hr />
							<div class="phone-layer">
								<?php foreach( $addresses_list as $list ) : ?>
									<h4 class="text-center"><?php echo $list->city; ?></h4>
									<h4 class="text-center"><?php echo $list->address; ?></h4>
									<a href="tel:<?php echo preg_replace( '/\s/', '', $list->phone ); ?>" rel="nofollow"><h3 class="text-center phone"><span class="glyphicon glyphicon-earphone"></span> <?php echo $list->phone; ?></h3></a>
									<hr />
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<?php if( class_exists( 'JLCContact' ) ) : ?>
				<div class="col-xs-12 col-sm-6 contact">
					<h2 class="text-center"><?php echo esc_html( __( 'Do we help you choose?', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
					<h3 class="text-center"><?php echo esc_html( __( 'Leave us your contact information', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h3>
					<?php echo JLCContact::get_contact_form(); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
