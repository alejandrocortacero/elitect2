<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
// Esta pagina antes no se utilizaba y para el contacto se utiliza page.php con un contenido predefinido al instalar. Como no se puede modificar el contentido preinstalado, no se podía cambiar el teléfono, por lo que se ha pasado este contenido aquí.
get_header('noopen');
?>
<div class="container first-container">
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'pagebg' ); ?>
	<div class="row">
		<div class="col-xs-12 page-content">
			<h1 class="text-center"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<?php echo do_shortcode( '[jlc_contact_form /]' ); ?>
		</div>
		<div class="col-xs-12 col-sm-6">
			<p>Contáctanos vía teléfono, whatsapp o enviando el formulario de contacto. Estamos aquí para solucionar y atender todas tus dudas.</p>
			<?php $phone = esc_attr( EliteTrainerSiteThemeCustomizer::get_contact_phone() ); ?>
			<?php if( !empty( $phone ) ) : ?>
			<p class="text-center">
				<a class="tel-link" href="tel:<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow"><i class="fa fa-whatsapp"></i> <span class="number"><?php echo $phone; ?></span></a> 
			</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer('noclose'); ?>
