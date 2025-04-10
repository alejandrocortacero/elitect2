<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<nav class="navbar navbar-default navbar-fixed-top <?php echo implode( ' ', apply_filters( 'navbar-default-extra-classes', array() ) ); ?>">
	<div class="container-fluid">
		<div class="navbar-header">
			<button style="display: none;" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-links-bar" aria-expanded="false">
				<span class="sr-only"><?php echo esc_html( _e( 'Toggle navigation', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo home_url(); ?>/">
				<img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>" />
				<span class="site-text">eliteclubtraining</span>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navigation-links-bar">
			<?php PersonalTrainerTheme::print_header_menu(); ?>
		</div>
	</div>
</nav>
