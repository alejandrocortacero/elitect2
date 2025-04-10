<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( $training ? $training->name : 'Nuevo entrenamiento' ); ?></h1>
	<hr />
	<?php echo self::get_edit_preset_training_form( $training ? $training->ID : null ); ?>
</div>
