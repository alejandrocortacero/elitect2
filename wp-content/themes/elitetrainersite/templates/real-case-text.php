<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="col-xs-12 col-sm-6 text">
	<h3><?php echo esc_html( $c->post_title ); ?></h3>
	<div class="inner-text"><?php echo wpautop( wp_kses_post( $c->post_content ) ); ?></div>
	<?php if( EliteTrainerSiteThemeCustomizer::can_edit() ) : ?>
	<p>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-case-modal" data-case="<?php echo esc_attr( $c->ID ); ?>">Editar caso</button>
		<a class="btn btn-primary" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_REAL_CASE_ACTION; ?>&case=<?php echo esc_attr( $c->ID ); ?>">Borrar caso</a>
	</p>
	<?php endif; ?>
</div>
