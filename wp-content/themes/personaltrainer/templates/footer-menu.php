<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<footer class="lazy-load main-footer" <?php if( false ) : ?>data-lazy="footer/menu"<?php endif; ?>>
	<nav class="navbar-footer">
		<div class="container">
			<div class="row links">
				<div class="col-xxs-12 col-xs-12 col-sm-4">
					<img class="img-responsive center-block logo" alt="Logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" />
				</div>
				<div class="col-xxs-12 col-xs-12 col-sm-4">
					<h4><?php echo esc_html( __( 'Sitemap', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h4>
					<ul class="list-unstyled">
					<?php foreach( PersonalTrainerTheme::get_default_menu_items() as $item ) : ?>
						<li class=""><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a></li>
					<?php endforeach; ?>
					</ul>
				</div>
<?php if( false ) : ?>
				<div class="col-xxs-12 col-xs-12 col-sm-3">
				</div>
<?php endif; ?>
				<div class="col-xxs-12 col-xs-12 col-sm-4">
				</div>
				<div class="col-xxs-12 col-xs-12">
					<hr/>
				</div>
			</div>
			<div class="row footer-legal">
				<div class="col-xxs-12 col-xs-12">
					<p class="text-center">&copy; 2019<?php foreach( PersonalTrainerTheme::get_legal_menu_items() as $item ) : ?> | <a href="<?php echo esc_url( $item['url'] ); ?>" rel="bookmark"><?php echo esc_html( $item['text'] ); ?></a><?php endforeach; ?></p>
				</div>
			</div>
		</div>
	</nav>
</footer>
<?php if( is_super_admin() ) : ?>
<div class="super-admin-menu" style="position:fixed; bottom:5px; left:5px; background-color:#fff; padding:5px; z-index:200000;">
	<a class="btn btn-primary" href="<?php echo get_permalink( get_option( PersonalTrainerTheme::SUPERTRAINER_PAGE_GENERAL_KEY ) ); ?>">Superadmin</a>
</div>
<?php endif; ?>
