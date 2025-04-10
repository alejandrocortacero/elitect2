<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
</tbody></table>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( __( 'Settings', self::TEXT_DOMAIN ) ); ?></h1>
	<hr />
	<?php $settings_form->print_admin_form(); ?>
</div>
