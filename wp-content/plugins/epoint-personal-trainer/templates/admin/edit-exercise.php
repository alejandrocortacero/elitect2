<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( $exercise ? $exercise->name : 'Nuevo ejercicio' ); ?></h1>
	<hr />
	<?php echo self::get_edit_preset_exercise_form( $exercise ? $exercise->ID : null ); ?>
</div>
