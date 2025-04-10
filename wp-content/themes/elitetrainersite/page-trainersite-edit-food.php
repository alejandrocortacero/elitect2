<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();

add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'page-trainer-edit-food'; return $classes; }, 10, 2 );

$food_id = isset( $_GET['food'] ) ? (int)$_GET['food'] : null;
$food = $food_id && class_exists( 'EpointPersonalTrainerMapper', false ) ? EpointPersonalTrainerMapper::get_food( $food_id ) : null;

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1><?php if( $food ) : ?><?php echo esc_html( $food->name ); ?><?php else : ?>Nuevo alimento<?php endif; ?></h1>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_food_list_url(); ?>" rel="nofollow">Volver a la lista</a></p>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

						<?php echo EpointPersonalTrainerPublic::get_edit_food_form( $food_id ); ?>

					<?php endif; ?>
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
