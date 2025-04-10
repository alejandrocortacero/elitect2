<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="exercise" data-exercise-id="<?php echo esc_attr( $e->ID ); ?>" data-exercise-cat-id="<?php echo esc_attr( $cat_id ); ?>" data-position="<?php echo esc_attr( $e->position ); ?>">
	
	<div class="exercise-position-controls">
		<div class="move move-up"><span class="glyphicon glyphicon-chevron-up"></span></div>
		<div class="move move-down"><span class="glyphicon glyphicon-chevron-down"></span></div>
	</div>

	<div class="content">
		<div class="name"><?php echo esc_html( $e->name ); ?></div>
		<div class="series"><label>Series</label><input class="series-input" type="text" maxlength="100" value="<?php echo esc_attr( $e->series ); ?>" /></div>
		<div class="repetitions"><label>Repeticiones</label><input class="repetitions-input" type="text" maxlength="100" value="<?php echo esc_attr( $e->repetitions ); ?>" /></div>
		<div class="loads"><label>Cargas</label><input class="loads-input" type="text" maxlength="100" value="<?php echo esc_attr( $e->loads ); ?>" /></div>
		<div class="description"><label>Extra</label><input class="description-input" type="text" value="<?php echo esc_attr( $e->extradescription ); ?>" /></div>
	</div>
</div>
