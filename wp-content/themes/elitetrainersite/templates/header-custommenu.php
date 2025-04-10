<?php defined( 'ABSPATH' ) or die( 'Wrong access' ); ?>
<?php $ordered_items = EliteTrainerSiteTheme::get_menu_items( 'elitetrainersite-header-menu' ); ?>
<ul class="nav navbar-nav navbar-right">
<?php foreach( $ordered_items as $item ) : ?>
	<?php EliteTrainerSiteTheme::print_menu_item( $item ); ?>
<?php endforeach; ?>
</ul>
