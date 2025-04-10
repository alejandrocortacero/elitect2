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
		<div class="form-group">
			<a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_food_url(); ?>" rel="nofollow">Añadir alimento</a>
		</div>
		<div class="form-group">
			<a class="btn btn-primary" href="#" rel="nofollow" data-toggle="modal" data-target="#add-food-category-modal">Añadir categoría</a>
		</div>
		<div class="form-group">
			<a class="btn btn-primary" href="#" rel="nofollow" data-toggle="modal" data-target="#food-categories-modal">Editar mis categorías</a>
		</div>
	</div>
</div>
