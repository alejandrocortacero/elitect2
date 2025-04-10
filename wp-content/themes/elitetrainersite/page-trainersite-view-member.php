<?php defined( 'ABSPATH' ) or die('Wrong Access!');
$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = get_user_by( 'ID', $member_id );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1><?php echo esc_html( $member->display_name ); ?></h1>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_members_list_url(); ?>">Volver a la lista</a></p>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<h2>Entrenamientos</h2>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_view_member_training_url( $member_id ); ?>">Ver entrenamientos</a></p>
					

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
