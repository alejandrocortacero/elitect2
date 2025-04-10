<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
</tbody></table>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( __( 'Registered forms', self::TEXT_DOMAIN ) ); ?> <a class="button button-primary" href="<?php echo esc_url( add_query_arg( array( 'help' => 'true' ) ) ); ?>" /><?php echo esc_html( __( 'Help', self::TEXT_DOMAIN ) ); ?></a></h1>
	<hr />
	<form method="post">
		<?php
		$list_table->prepare_items();
		$list_table->display();
		?>
	</form>
</div>
