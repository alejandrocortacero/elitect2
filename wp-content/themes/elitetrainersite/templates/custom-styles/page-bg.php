<?php defined( 'ABSPATH' ) or die( 'Wrong Acess' );
$bg_pages = EliteTrainerSiteThemeCustomizer::get_bg_pages(); ?>
<?php foreach( $bg_pages as $p ) : ?>
	<?php if( ( $p_bg = EliteTrainerSiteThemeCustomizer::get_page_bg( $p ) ) ) : ?>
		<?php EliteTrainerSiteThemeCustomizer::print_bg_rules( 'body.page-id-' . $p, $p_bg, false ); ?>
	<?php endif; ?>
<?php endforeach; ?>
