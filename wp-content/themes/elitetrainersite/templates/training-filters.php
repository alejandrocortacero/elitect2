<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
	<div class="training-filters-toggler-layer multi-row">
		<button class="training-filters-toggler btn btn-primary">
			<span class="text show-filters">Mostrar filtros</span>
			<span class="text hide-filters">Ocultar filtros</span>
			<span class="glyphicon glyphicon-filter"></span>
		</button>
	</div>
<div class="training-filters pull-right">
	<div class="training-filters-toggler-layer one-row">
		<button class="training-filters-toggler btn btn-primary">
			<span class="text show-filters">Mostrar filtros</span>
			<span class="text hide-filters">Ocultar filtros</span>
			<span class="glyphicon glyphicon-filter"></span>
		</button>
	</div>
	<div class="training-filter training-objectives-filter form-inline">
		<div class="form-group">
			<label>Objetivos</label>
			<div class="objectives-layer checkboxes-layer">
			<?php foreach( $objectives as $objective ) : ?>
				<div class="checkbox">
					<input type="checkbox" data-objective="<?php echo esc_attr( $objective->ID ); ?>" id="filter-objective-<?php echo esc_attr( $objective->ID ); ?>" class=" input-checkbox cool" value="yes" <?php if( in_array( $objective->ID, $selected_objectives ) ) : ?>checked="checked"<?php endif; ?>>
					<label for="filter-objective-<?php echo esc_attr( $objective->ID ); ?>"> <span class="checker"></span> <?php echo esc_html( $objective->name ); ?></label>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="training-filter training-environments-filter form-inline">
		<div class="form-group">
			<label>Entornos</label>
			<div class="environments-layer checkboxes-layer">
			<?php foreach( $environments as $environment ) : ?>
				<div class="checkbox">
					<input type="checkbox" data-environment="<?php echo esc_attr( $environment->ID ); ?>" id="filter-environment-<?php echo esc_attr( $environment->ID ); ?>" class=" input-checkbox cool" value="yes" <?php if( in_array( $environment->ID, $selected_environments ) ) : ?>checked="checked"<?php endif; ?>>
					<label for="filter-environment-<?php echo esc_attr( $environment->ID ); ?>"> <span class="checker"></span> <?php echo esc_html( $environment->name ); ?></label>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="training-filter training-objectives-filter form-inline">
<p>Aquí prodras filtrar el entrenamiento que buscas según los filtros elegidos</p>
	</div>
</div>
