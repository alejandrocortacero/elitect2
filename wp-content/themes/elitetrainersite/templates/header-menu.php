<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<nav class="navbar navbar-default header-navbar navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo home_url(); ?>/">
				<div class="logo">
					<img src="<?php echo EliteTrainerSiteThemeCustomizer::get_header_logo_url(); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" />
				</div>
				<div class="text">
					<p class="site-title"><?php echo EliteTrainerSiteThemeCustomizer::get_header_title(); ?></p>
					<p class="site-description"><?php echo EliteTrainerSiteThemeCustomizer::get_header_subtitle(); ?></p>
				</div>
			</a>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'headernavbar' ); ?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-links-bar" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="phone-layer">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-links-bar" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<?php $phone = esc_attr( EliteTrainerSiteThemeCustomizer::get_contact_phone() ); ?>
			<?php if( !empty( $phone ) ) : ?>
				<?php if( false ) : ?>
				<a class="whatsapp-link" href="whatsapp://send/?phone=<?php echo preg_replace( '/\D/', '', $phone ); ?>&text&source&data&app_absent" rel="nofollow"><i class="fa fa-whatsapp"></i></a> 
				<?php else : ?>
				<a class="whatsapp-link" href="https://api.whatsapp.com/send?phone=+34<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow"><i class="fa fa-whatsapp"></i></a> 
				<?php endif; ?>
			<a class="tel-link" href="tel:<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow"><i class="fa fa-phone"></i> <span class="number"><?php echo $phone; ?></span></a> 
			<?php endif; ?>

			<?php if( false && current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
				<button class="edit-section-button" data-toggle="modal" data-target="#header-navbar-modal"><span class="glyphicon glyphicon-wrench"></span></button>
			<?php endif; ?>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'contactdata' ); ?>

		</div>
	</div>
</nav>
<nav class="navbar main-menu-navbar">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="navigation-links-bar">
			<?php EliteTrainerSiteTheme::print_header_menu(); ?>
			<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'mainmenu' ); ?>
		</div>
	</div>
</nav>
<nav class="navbar submenu-navbar">
	<div class="container-fluid">
		<div class="row two-links-row">
			<div class="col-xs-12 col-sm-6 my-profile-col">
				<a class="my-profile" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>" rel="nofollow"><span class="glyphicon glyphicon-user"></span> Mi perfil</a>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'submenu' ); ?>
			</div>
			<div class="col-xs-12 col-sm-6 call-you-col">
				<a class="we-call-you" href="#" rel="nofollow" data-toggle="modal" data-target="#we-call-you-modal"><span class="glyphicon glyphicon-earphone"></span> Info / Te llamamos</a>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'submenu2' ); ?>
			</div>
		</div>
	</div>
</nav>
<div class="header-separator"></div>
<?php if( false && is_user_logged_in() ) : ?>
<?php $user = wp_get_current_user(); ?>
<nav class="navbar user-navbar">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 user-menu-col">
				<div class="we-call-you-layer">
					<a class="we-call-you" href="#" rel="nofollow" data-toggle="modal" data-target="#we-call-you-modal"><span class="glyphicon glyphicon-earphone"></span> Te llamamos</a>
				</div>
				<div class="user-links">
					<img src="<?php echo get_template_directory_uri(); ?>/img/user/blank.jpg" alt="usuario" />
					<span class="user-name"><?php echo esc_html( $user->display_name ); ?></span>
					<button type="button" class="user-menu-button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</nav>
<?php endif; ?>
