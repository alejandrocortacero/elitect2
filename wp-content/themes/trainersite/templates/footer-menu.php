<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<footer class="lazy-load main-footer" <?php if( false ) : ?>data-lazy="footer/menu"<?php endif; ?>>
	<nav class="navbar-footer">
		<div class="container">
			<div class="row links">
				<div class="col-xxs-12 col-xs-12 col-sm-4">
					<img class="img-responsive center-block logo" alt="Logo" src="<?php echo TrainerSiteTheme::get_big_logo_url(); ?>" />
				</div>
				<div class="col-xxs-12 col-xs-12 col-sm-4">
					<h4><?php echo esc_html( __( 'Sitemap', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h4>
					<ul class="list-unstyled">
					<?php foreach( TrainerSiteTheme::get_default_menu_items() as $item ) : ?>
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
					<p class="text-center">&copy; 2020<?php foreach( TrainerSiteTheme::get_legal_menu_items() as $item ) : ?> | <a href="<?php echo esc_url( $item['url'] ); ?>" rel="bookmark"><?php echo esc_html( $item['text'] ); ?></a><?php endforeach; ?></p>
				</div>
			</div>
		</div>
	</nav>
</footer>
