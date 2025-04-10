<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Exercises', EpointPersonalTrainer::TEXT_DOMAIN ); ?>
	</h1>
	<a class="page-title-action" href="<?php printf( 
		'?page=%s&action=edit&exercise=new',
		esc_attr( $_REQUEST['page'] )
	); ?>">Nuevo ejercicio</a>
	<hr />

	<form method="post">
		<?php
		$list_table->prepare_items();
		$list_table->display();
		?>
	</form>

</div>
