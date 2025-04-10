<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<?php if( !is_user_logged_in() || !is_user_member_of_blog() ) : ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 page-content">
			<h2 class="cool-heading"><?php echo esc_html( __( 'Log in', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			<?php wp_login_form(); ?>
		</div>
		<div class="col-xs-12 col-sm-6 page-content">
			<h2 class="cool-heading"><?php echo esc_html( __( 'Register', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			<?php echo EpointPersonalTrainer::get_register_user_form(); ?>
		</div>
	</div>
</div>
<?php else : ?>
<?php $user = wp_get_current_user(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 page-content">
			<h2>Hola <?php echo $user->display_name; ?></h2>
			<p><a href="<?php echo wp_logout_url( get_bloginfo( 'url' ) ); ?>">Logout</a></p>
			<?php if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
				<h2 class="cool-heading"><?php echo esc_html( __( 'Alerts', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My clients', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My exercises gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My training gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My food gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My diet gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			<?php else : ?>
				<h2 class="cool-heading"><?php echo esc_html( __( 'Pending data', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My progression', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<?php $front = get_user_meta( $user->ID, 'front_photo', true ); ?>
						<img src="<?php echo wp_get_attachment_url( $front ); ?>" alt="Front" class="img-responsive center-block" />
					</div>
					<div class="col-xs-12 col-sm-6">
						<?php $profile = get_user_meta( $user->ID, 'profile_photo', true ); ?>
						<img src="<?php echo wp_get_attachment_url( $profile ); ?>" alt="Profile" class="img-responsive center-block" />
					</div>
				</div>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My training', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
				<h2 class="cool-heading"><?php echo esc_html( __( 'My diet', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer('noclose'); ?>
