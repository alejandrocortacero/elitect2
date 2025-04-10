<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Contacts', self::TEXT_DOMAIN ); ?>
	</h1>
	<hr />

	<form method="post">
		<?php
		$list_table->prepare_items();
		$list_table->display();
		?>
	</form>

</div>
