<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<nav class="tags">
	<h4><?php _e( 'Tags', TrainerSiteTheme::TEXT_DOMAIN ); ?></h4>
	<ul class="nav nav-pills nav-stacked">
	<?php foreach( TrainerSiteTheme::get_news_tags() as $cat ) : ?>
		<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>"><span class="fa fa-tags"></span> <?php echo esc_html( $cat->name ); ?></a></li>
	<?php endforeach; ?>
	</ul>
</nav>
