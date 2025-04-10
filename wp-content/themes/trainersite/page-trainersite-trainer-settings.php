<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<?php if( is_user_logged_in() && is_user_member_of_blog() && current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
<?php $user = wp_get_current_user(); ?>
<?php get_template_part( 'templates/settings', 'menu' ); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 page-content trainer-settings-content">
			<h1 class="cool-heading"><?php echo esc_html( __( 'Trainer settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
			<h3 class="text-center">Administre el aspecto de su sitio y las galerías de entrenamientos y dietas predefinidas.</h3>
			<div class="links">
				<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SITE_STYLE_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Site Settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>">
					<div class="image">
						<?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'site_settings.svg' ) ); ?>
					</div>
					<div class="text">
						<p><?php echo esc_attr( __( 'Site Settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
					</div>
				</a>
				<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::HOME_SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Home Settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>">
					<div class="image">
						<?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'house_settings.svg' ) ); ?>
					</div>
					<div class="text">
						<p><?php echo esc_attr( __( 'Home Settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
					</div>
				</a>
				<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::TRAINER_EXERCISES_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Exercises Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>">
					<div class="image">
						<?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'exercises.svg' ) ); ?>
					</div>
					<div class="text">
						<p><?php echo esc_attr( __( 'Exercises Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
					</div>
				</a>
				<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Training Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>">
					<div class="image">
						<?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'help.svg' ) ); ?>
					</div>
					<div class="text">
						<p><?php echo esc_attr( __( 'Training Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
					</div>
				</a>
				<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Food Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>">
					<div class="image">
						<?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'help.svg' ) ); ?>
					</div>
					<div class="text">
						<p><?php echo esc_attr( __( 'Food Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
					</div>
				</a>
				<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Diets Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>">
					<div class="image">
						<?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'help.svg' ) ); ?>
					</div>
					<div class="text">
						<p><?php echo esc_attr( __( 'Diets Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer('noclose'); ?>
