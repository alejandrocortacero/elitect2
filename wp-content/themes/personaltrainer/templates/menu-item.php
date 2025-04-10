<?php defined( 'ABSPATH' ) or die( 'Wrong access' ); ?>
<?php if(empty( $item->children ) ) : ?>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home"><a href="<?php echo esc_url( $item->url ); ?>"><?php echo esc_html( $item->title ); ?></a></li>
<?php else : ?>
	<li class="dropdown">
		<a href="<?php echo esc_url( $item->url ); ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo esc_html( $item->title ); ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php foreach( $item->children as $child ) : ?>
			<?php PersonalTrainerTheme::print_menu_item( $child ); ?>
		<?php endforeach; ?>
		</ul>
	</li>
<?php endif; ?>
