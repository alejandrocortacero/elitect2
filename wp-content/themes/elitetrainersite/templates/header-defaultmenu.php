<?php defined( 'ABSPATH' ) or die( 'Wrong access' ); ?>
<ul class="nav navbar-nav navbar-left">
<?php foreach( EliteTrainerSiteTheme::get_default_menu_items() as $item ) : ?>
	<?php if( empty( $item['children'] ) ) : ?>
		<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home"><a href="<?php echo esc_url( $item['url'] ); ?>" aria-label="<?php echo esc_attr( $item['text'] ); ?>">
			<?php if( !empty( $item['icon'] ) ) : ?>
				<span class="hidden-xs glyphicon glyphicon-<?php echo esc_attr( $item['icon'] ); ?>"></span><span class="visible-xs"><?php echo esc_html( $item['text'] ); ?></span>
			<?php else : ?>
				<?php echo esc_html( $item['text'] ); ?>
			<?php endif; ?>
		</a></li>
	<?php else : ?>
		<li class="dropdown">
			<a href="<?php echo esc_url( $item['url'] ); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo esc_html( $item['text'] ); ?> <span class="caret"></span></a>
			<ul class="dropdown-menu">
			<?php foreach( $item['children'] as $child ) : ?>
				<li><a href="<?php echo esc_url( $child['url'] ); ?>" rel="bookmark"><?php echo esc_html( $child['text'] ); ?></a></li>
			<?php endforeach; ?>
			</ul>
		</li>
	<?php endif; ?>
<?php endforeach; ?>
</ul>
