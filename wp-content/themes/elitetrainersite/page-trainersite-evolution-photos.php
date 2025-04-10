<?php defined( 'ABSPATH' ) or die('Wrong Access!');
$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = get_user_by( 'ID', $member_id );

$photos = class_exists( 'EpointPersonalTrainerMapper', false ) ? EpointPersonalTrainerMapper::get_user_evolution_photos( $member_id ) : null;

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-member-evolution-photos'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<h1><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $member_id ); ?>">Volver al perfil</a> Fotos de evolución de <?php echo esc_html( $member->display_name ); ?></h1>
				<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

					<?php if( !empty( $photos ) ) : ?>
						<div class="row photos-evolution">
						<?php foreach( $photos as $row ) : ?>
								<div class="col-xs-4 col-xs-offset-0 photo-layer front-photo">
									<?php if( $row->front ) : ?><img class="img-responsive" src="<?php echo wp_get_attachment_image_url( $row->front, EliteTrainerSiteTheme::EVOLUTION_IMAGE_SIZE ); ?>" alt="De frente" /><?php endif; ?>
								</div>
								<div class="col-xs-4 col-xs-offset-0 photo-layer profile-photo">
									<?php if( $row->profile ) : ?><img class="img-responsive" src="<?php echo wp_get_attachment_image_url( $row->profile, EliteTrainerSiteTheme::EVOLUTION_IMAGE_SIZE ); ?>" alt="De perfil" /><?php endif; ?>
								</div>
								<div class="col-xs-4 col-xs-offset-0 photo-layer back-photo">
									<?php if( $row->back ) : ?><img class="img-responsive" src="<?php echo wp_get_attachment_image_url( $row->back, EliteTrainerSiteTheme::EVOLUTION_IMAGE_SIZE ); ?>" alt="De espaldas" /><?php endif; ?>
								</div>
								<div class="col-xs-12 date"><br/><p class="text-center"><?php echo date( 'd/m/Y', strtotime( $row->when ) ); ?></p><br/></div>
						<?php endforeach; ?>
						</div>
					<?php else : ?>
						<p>No se han subido fotos aun.</p>
					<?php endif; ?>

					<hr />
					<?php echo EpointPersonalTrainerPublic::get_member_evolution_photos_form( $member_id ); ?>

				<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
