<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Training templates', EpointPersonalTrainer::TEXT_DOMAIN ); ?>
	</h1>
	<a class="page-title-action" href="<?php printf( 
		'?page=%s&action=edit&training=new',
		esc_attr( $_REQUEST['page'] )
	); ?>">Nuevo entrenamiento</a>
	<hr />

	<form method="post">
		<?php
		$list_table->prepare_items();
		$list_table->display();
		?>
	</form>

</div>
