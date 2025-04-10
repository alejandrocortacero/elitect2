<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<footer class="lazy-load main-footer" <?php if( false ) : ?>data-lazy="footer/menu"<?php endif; ?>>
	<nav class="navbar-footer">
		<div class="container">
			<div class="row links">
				<div class="col-xs-12">
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'footer' ); ?>
					<p class="text-center"><?php foreach( EliteTrainerSiteTheme::get_legal_menu_items() as $item ) : ?> <a href="<?php echo esc_url( $item['url'] ); ?>" rel="bookmark"><?php echo esc_html( $item['text'] ); ?></a><?php endforeach; ?></p>
				</div>
			

			</div>
			<div class="row footer-legal">
				<div class="col-xxs-12 col-xs-12">
					<p class="text-center">Copyright 2020 © Elite Club Training - Todos los derechos reservados<br />Diseño web para empresas epoint.es</p>
				</div>
			</div>
		</div>
	</nav>
</footer>
