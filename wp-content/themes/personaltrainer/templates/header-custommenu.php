<?php defined( 'ABSPATH' ) or die( 'Wrong access' ); ?>
<?php $ordered_items = PersonalTrainerTheme::get_menu_items( 'personaltrainer-header-menu' ); ?>
<ul class="nav navbar-nav navbar-right">
<?php foreach( $ordered_items as $item ) : ?>
	<?php PersonalTrainerTheme::print_menu_item( $item ); ?>
<?php endforeach; ?>
</ul>
