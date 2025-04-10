<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();
$food_categories = EpointPersonalTrainerMapper::get_blog_food_categories( get_current_blog_id() );

/*
wp_enqueue_script(
	'trainersite-exercises-script',
	get_template_directory_uri() . '/js/exercises.js',
	array( 'jquery' ),
	'1.0',
	true
);
wp_localize_script(
	'trainersite-exercises-script',
	'EliteTrainerSiteExercisesGalleryNS',
	array(
		'exerciseTabCookie' => EliteTrainerSiteTheme::EXERCISE_TAB_COOKIE
	)
);
*/


$last_food = isset( $_COOKIE[EliteTrainerSiteTheme::LAST_FOOD_COOKIE] ) ? sanitize_text_field( $_COOKIE[EliteTrainerSiteTheme::LAST_FOOD_COOKIE] ) : null;
if( $last_food )
{
	setCookie( EliteTrainerSiteTheme::LAST_FOOD_COOKIE, '', time() + 24*60*60*1000, '/' );
}

add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'page-trainer-food-list'; return $classes; }, 10, 2 );

/*
if( EliteTrainerSiteTheme::must_show_duplicate_exercise_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-duplication'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_delete_exercise_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-deletion'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_edit_exercise_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-edition'; return $classes; }, 10, 2 );
*/
?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1>Alimentos <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>" rel="nofollow">Volver al panel principal</a></h1>
						<div class="tools-bar right">
							<?php EliteTrainerSiteTheme::print_food_filters(); ?>
						</div>
						<?php $add_category_form = EpointPersonalTrainerPublic::get_add_food_category_form_object(); ?>
						<?php $edit_category_form = EpointPersonalTrainerPublic::get_edit_food_category_form_object( null ); ?>
						<div class="notices">
							<?php $add_category_form->print_public_notices(); ?>
							<?php $edit_category_form->print_public_notices(); ?>
						</div>
		
						<div class="food-items">
						<?php $food_categories = EpointPersonalTrainerMapper::get_food_items_grouped_by_category(null, null, get_current_blog_id() ); ?>
						<?php foreach( $food_categories as $fc ) : ?>

							<h2><?php echo esc_html( $fc->name ); ?></h2>
							<div class="table-responsive"><table class="table table-striped items-table">
								<thead><tr>
									<th>Nombre</th>
									<th></th>
								</tr></thead>
								<tbody>
								<?php foreach( $fc->food as $f ) : ?>
									<tr class="food-item food-<?php echo $fc->ID; ?> <?php if( $f->ID == $last_food ) : ?>new-duplicated<?php endif; ?>">

										<td class="small-full-width">
											<a href="<?php echo EliteTrainerSiteTheme::get_edit_food_url( $f->ID ); ?>" class="edit-food" data-food="<?php echo $f->ID; ?>" title="Editar"><?php echo $f->name; ?></a>
										</td>
										<td class="actions">
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_food_url( $f->ID ); ?>" class="edit-food" data-food="<?php echo $f->ID; ?>" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
			<?php if( $f->trainer ) : ?>
				<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_FOOD_ACTION; ?>&food=<?php echo $f->ID; ?>" title="Eliminar" class="delete-food"><span class="glyphicon glyphicon-trash"></span></a>
			<?php endif; ?>
										</td>

									</tr>
								<?php endforeach; ?>
								</tbody>
							</table></div>

						<?php endforeach; ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>
<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php if( false && EliteTrainerSiteTheme::must_show_duplicate_exercise_confirmation() ) : ?>
<div class="modal fade" id="confirm-duplication" tabindex="-1" role="dialog" aria-labelledby="confirm-duplication-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-duplication-label">Duplicar ejercicio</h4>
      </div>
      <div class="modal-body">
			<p>Este ejercicio de duplicará y aparecerá en tu listado de ejercicios propios, dándote la opción de  modificar las fotos o texto o ambos y así tener un nuevo ejercicio en tu listado de" ejercicios propios" de forma cómoda y rápida.</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary" data-base-url="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_EXERCISE_ACTION; ?>&exercise=" data-exercise="">Duplicar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-duplication-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-duplication-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if( false && EliteTrainerSiteTheme::must_show_delete_exercise_confirmation() ) : ?>
<div class="modal fade" id="confirm-deletion" tabindex="-1" role="dialog" aria-labelledby="confirm-deletion-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-deletion-label">Eliminar ejercicio</h4>
      </div>
      <div class="modal-body">
			<p>El ejercicio será eliminado permanentemente. ¿Desea continuar?</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary" data-base-url="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_EXERCISE_ACTION; ?>&exercise=" data-exercise="">Eliminar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-deletion-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-deletion-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if( false && EliteTrainerSiteTheme::must_show_edit_exercise_confirmation() ) : ?>
<div class="modal fade" id="confirm-edition" tabindex="-1" role="dialog" aria-labelledby="confirm-edition-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-edition-label">Editar ejercicio</h4>
      </div>
      <div class="modal-body">
			<p>A continuación podrá modificar las características del ejercicio: nombre, vídeo, descripción... ¿Desea continuar?</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary">Editar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-edition-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-edition-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="modal fade" id="add-food-category-modal" tabindex="-1" role="dialog" aria-labelledby="add-food-category-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="add-food-category-modal-label">Crear nueva categoría</h4>
      </div>
      <div class="modal-body">
			<?php echo EpointPersonalTrainerPublic::get_add_food_category_form(); ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function prepareEditCatForm(a,b,c)
{
	a.find('input[name="name"]').val(c);
	a.find('input[name="category"]').val(b);
}
</script>
<div class="modal fade" id="food-categories-modal" tabindex="-1" role="dialog" aria-labelledby="food-categories-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="food-categories-modal-label">Categorías de alimento</h4>
      </div>
      <div class="modal-body">
		<a class="btn btn-primary" href="#" rel="nofollow" onclick="jQuery('#food-categories-modal').modal('hide');" data-toggle="modal" data-target="#add-food-category-modal">Crear nueva categoría</a>
		<?php $categories = EpointPersonalTrainerMapper::get_blog_food_categories( get_current_blog_id(), null, null, 'name', 'ASC' ); ?>
		<div class="table-responsive">
			<table class="table table-striped items-table">
				<tbody>
				<?php foreach( $categories as $cat ) : ?>
					<tr>
						<td><?php echo esc_html( $cat->name ); ?></td>
						<td class="actions">
							<a href="#" class="edit-exercise-cat" data-exercise-cat="<?php echo $cat->ID; ?>" title="Editar" onclick="jQuery('.cat-cel').hide(); var x = jQuery(event.currentTarget).closest('tr').next('tr.edit-cat-cel'); prepareEditCatForm(x, <?php echo $cat->ID ?>, '<?php echo $cat->name; ?>');x.show();return false;"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="#" class="remove-exercise-cat" data-exercise-cat="<?php echo $cat->ID; ?>" title="Eliminar" onclick="jQuery('.cat-cel').hide(); var x = jQuery(event.currentTarget).closest('tr').nextAll('tr.remove-cat-cel').first(); console.log(x); ;x.show();return false;"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
					<tr class="cat-cel edit-cat-cel" style="display:none;">
						<td colspan="2">
							<?php echo EpointPersonalTrainerPublic::get_edit_food_category_form( $cat->ID ); ?>
						</td>
					</tr>

					<tr class="cat-cel remove-cat-cel" style="display:none;">
						<td colspan="2">
							<?php $ex_count = (int)EpointPersonalTrainerMapper::get_food_items_count_in_category( $cat->ID ); ?>
							<?php if( $ex_count ) : ?>
								<p class="alert alert-danger"><?php echo esc_html( $ex_count != 1 ? sprintf( 'Si borra esta categoría se eliminarán %d alimentos. ¿Desea continuar?', $ex_count ) : 'Si borra esta categoría se eliminará 1 alimento. ¿Desea continuar?' ); ?></p>
							<?php else : ?>
								<p class=""><?php echo esc_html( '¿Está seguro de eliminar la categoría?' ); ?></p>
							<?php endif; ?>
							<p><a class="btn btn-primary" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_FOOD_CATEGORY_ACTION; ?>&category=<?php echo $cat->ID; ?>" title="Eliminar" class="delete-exercise-cat">Eliminar</a></p>
						</td>
					</tr>

				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
      </div>
    </div>
  </div>
</div>

<?php if( false ) : ?>


<script type="text/javascript">
(function($){
	$('#confirm-duplication').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var exerciseId = button.data('exercise');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.data('exercise',exerciseId);
	  link.prop('href',link.data('base-url') + exerciseId);
	});

	$('#confirm-deletion').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var exerciseId = button.data('exercise');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.data('exercise',exerciseId);
	  link.prop('href',link.data('base-url') + exerciseId);
	});

	$('#confirm-edition').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var exerciseId = button.data('exercise');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.prop('href',button.data('link'));
	});

	$('#not-show-duplication-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-duplication');
		}
		else
		{
			$('body').addClass('must-confirm-duplication');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'exercise_duplication',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
			complete:function(){
			},
			success: function(a,b,c){
			}
		});
	});

	$('#not-show-deletion-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-deletion');
		}
		else
		{
			$('body').addClass('must-confirm-deletion');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'exercise_deletion',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
		});
	});


	$('#not-show-edition-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-edition');
		}
		else
		{
			$('body').addClass('must-confirm-edition');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'exercise_edition',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
		});
	});
})(jQuery);
</script>
<?php endif; ?>
<?php get_footer( 'noclose' ); ?>
