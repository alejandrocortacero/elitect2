<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo home_url(); ?>/">
				<img src="<?php echo TrainerSiteTheme::get_small_logo_url(); ?>" alt="<?php bloginfo('name'); ?>" />
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navigation-links-bar">
			<?php TrainerSiteTheme::print_header_menu(); ?>
		</div>
	</div>
</nav>
