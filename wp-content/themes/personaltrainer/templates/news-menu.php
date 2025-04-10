<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<nav class="navbar navbar-news navbar-fixed-top">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li class="menu-item menu-item-type-custom menu-item-object-custom"><span class="fa fa-tags"></span></li>
		<?php foreach( PersonalTrainerTheme::get_news_tags( 6 ) as $cat ) : ?>
			<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</nav>
