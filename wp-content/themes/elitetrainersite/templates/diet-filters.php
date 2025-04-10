<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="food-filters pull-right">
	<div class="food-filter form-inline">
<?php if( false ) : ?>
		<div class="form-group">
			<label>Categorías</label>
			<select class="food-category-filter form-control">
				<option value="all" <?php if( $selected_category === null ) : ?>selected="selected"<?php endif; ?>>Todas</option>
			<?php foreach( $categories as $cat ) : ?>
				<option value="<?php echo esc_attr( $cat->ID ); ?>" <?php if( $selected_category === $cat->ID ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( $cat->name ); ?></option>
			<?php endforeach; ?>
			</select>
		</div>
<?php endif; ?>
<?php if( false ) : ?>
		<div class="form-group">
			<a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( null ); ?>" rel="nofollow">Añadir dieta</a>
		</div>
		<div class="form-group">
			<a class="btn btn-primary" href="#" rel="nofollow" data-toggle="modal" data-target="#add-food-category-modal">Añadir categoría</a>
		</div>
		<div class="form-group">
			<a class="btn btn-primary" href="#" rel="nofollow" data-toggle="modal" data-target="#food-categories-modal">Editar mis categorías</a>
		</div>
<?php endif; ?>
	</div>
</div>

	<div class="diet-filters-toggler-layer multi-row">
		<button class="diet-filters-toggler btn btn-primary">
			<span class="text show-filters">Mostrar filtros</span>
			<span class="text hide-filters">Ocultar filtros</span>
			<span class="glyphicon glyphicon-filter"></span>
		</button>
	</div>
<div class="diet-filters pull-right">
	<div class="diet-filters-toggler-layer one-row">
		<button class="diet-filters-toggler btn btn-primary">
			<span class="text show-filters">Mostrar filtros</span>
			<span class="text hide-filters">Ocultar filtros</span>
			<span class="glyphicon glyphicon-filter"></span>
		</button>
	</div>
	<div class="diet-filter diet-objectives-filter form-inline">
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
	<div class="diet-filter diet-restrictions-filter form-inline">
		<div class="form-group">
			<label>Restricciones</label>
			<div class="restrictions-layer checkboxes-layer">
			<?php foreach( $restrictions as $restriction ) : ?>
				<div class="checkbox">
					<input type="checkbox" data-restriction="<?php echo esc_attr( $restriction->ID ); ?>" id="filter-restriction-<?php echo esc_attr( $restriction->ID ); ?>" class=" input-checkbox cool" value="yes" <?php if( in_array( $restriction->ID, $selected_restrictions ) ) : ?>checked="checked"<?php endif; ?>>
					<label for="filter-restriction-<?php echo esc_attr( $restriction->ID ); ?>"> <span class="checker"></span> <?php echo esc_html( $restriction->name ); ?></label>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
