<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Exercise categories', EpointPersonalTrainer::TEXT_DOMAIN ); ?>
	</h1>
	<a class="page-title-action" href="<?php printf( 
		'?page=%s&action=edit&category=new',
		esc_attr( $_REQUEST['page'] )
	); ?>">Nueva categoría</a>
	<hr />

	<form method="post">
		<?php
		$list_table->prepare_items();
		$list_table->display();
		?>
	</form>

</div>
