<?php defined( 'ABSPATH' ) or die( 'Wrong access' ); ?>
<?php $ordered_items = TrainerSiteTheme::get_menu_items( 'trainersite-header-menu' ); ?>
<ul class="nav navbar-nav navbar-right">
<?php foreach( $ordered_items as $item ) : ?>
	<?php TrainerSiteTheme::print_menu_item( $item ); ?>
<?php endforeach; ?>
</ul>
