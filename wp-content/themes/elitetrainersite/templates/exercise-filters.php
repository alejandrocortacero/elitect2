<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="exercise-filters pull-right">
	<div class="exercise-filter form-inline">
		<div class="form-group">
			<label>Categorías</label>
			<select class="exercise-category-filter form-control">
				<option value="all" <?php if( $selected_category === null ) : ?>selected="selected"<?php endif; ?>>Todas</option>
			<?php foreach( $categories as $cat ) : ?>
				<option value="<?php echo esc_attr( $cat->ID ); ?>" <?php if( $selected_category === $cat->ID ) : ?>selected="selected"<?php endif; ?>><?php echo esc_attr( $cat->name ); ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<?php if( false ) : ?>
		<div class="form-group">
			<a class="btn btn-primary" href="#" rel="nofollow" data-toggle="modal" data-target="#exercise-categories-modal">Editar mis categorías</a>
		</div>
		<?php endif; ?>
	</div>
</div>
