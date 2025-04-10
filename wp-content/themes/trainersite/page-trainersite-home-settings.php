<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<?php if( is_user_logged_in() && is_user_member_of_blog() && current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
<?php $user = wp_get_current_user(); ?>
<?php get_template_part( 'templates/settings', 'menu' ); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 page-content">
			<h1 class="cool-heading"><?php echo esc_html( __( 'Home settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
			<?php echo TrainerSiteTheme::get_home_settings_form(); ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer('noclose'); ?>
