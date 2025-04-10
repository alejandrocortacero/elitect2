<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}


add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-trainer-alerts-settings';  return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1>Configuración de alertas</h1>
						<p>Las alarmas de recordatorio que recibirás tanto tu como entrenador, como tu cliente, serán las que marques en el siguiente formulario. Las alertas de entrenamientos y dietas seguirán la fecha que les pongas cuando los hagas, en cambio el resto de alertas se activaran según el espacio de dias que marques en este mismo panel (al marcar cada casilla se abrirá un contador que será el que personalices y marque los días entre un aviso y otro).</p>
						<p>Estos avisos comenzarán desde la fecha en la que tu socio sea pesado, medido, revisadas sus pruebas físicas, etc. Y será este espacio de días el aplicado a todos tus clientes.</p>

						<?php echo EpointPersonalTrainerAlerts::get_alerts_settings_form(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>
<?php //get_template_part( 'templates/contact', 'container' ); ?>


<?php get_footer( 'noclose' ); ?>

