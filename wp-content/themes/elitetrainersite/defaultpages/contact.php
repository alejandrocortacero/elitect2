<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="contaniner">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			[jlc_contact_form /]
		</div>
		<div class="col-xs-12 col-sm-6">
			<p>Contáctanos vía teléfono, whatsapp o enviando el formulario de contacto. Estamos aquí para solucionar y atender todas tus dudas.</p>
			<?php $phone = esc_attr( EliteTrainerSiteThemeCustomizer::get_contact_phone() ); ?>
			<?php if( !empty( $phone ) ) : ?>
			<p class="text-center tel">
				<a href="tel:<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow"><i class="fa fa-whatsapp"></i> <?php echo $phone; ?></a> 
			</p>
			<?php endif; ?>
		</div>
	</div>
</div>
