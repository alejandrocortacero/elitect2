<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( $category ? $category->name : 'Nuevo categoría de ejercicio' ); ?></h1>
	<hr />
	<?php echo self::get_edit_preset_category_form( $category ? $category->ID : null ); ?>
</div>
