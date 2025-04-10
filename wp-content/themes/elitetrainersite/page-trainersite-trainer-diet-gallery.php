<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$show_preset_diets = false;

$user = wp_get_current_user();
$objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( $user->ID );
$restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( $user->ID );


wp_enqueue_script( 'elitetrainersite-diet-gallery-js', get_template_directory_uri() . '/js/diet-gallery.js', array( 'jquery', 'elitetrainersite-navigation-js' ), '1.0', true );
wp_localize_script(
	'elitetrainersite-diet-gallery-js',
	'EliteTrainerSiteDietGalleryNS',
	array(
		'dietTabCookie' => EliteTrainerSiteTheme::DIET_TAB_COOKIE
	)
);

setCookie( EliteTrainerSiteTheme::LAST_PAGE_COOKIE, 'trainer-diet-gallery', time() + 24*60*60*1000, '/' );

add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'page-trainer-diet-list'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_duplicate_diet_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-diet-duplication'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_edit_diet_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-diet-edition'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_delete_diet_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-diet-deletion'; return $classes; }, 10, 2 );

$last_duplicated_diet = isset( $_COOKIE[EliteTrainerSiteTheme::DIET_LAST_DUPLICATED_COOKIE] ) ? (int)$_COOKIE[EliteTrainerSiteTheme::DIET_LAST_DUPLICATED_COOKIE] : null;
if( $last_duplicated_diet )
{
	setCookie( EliteTrainerSiteTheme::DIET_LAST_DUPLICATED_COOKIE, '', time() + 24*60*60*1000, '/' );
}

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1 style="display:flex;justify-content:space-between; align-items:flex-start;">Galería de dietas <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>" rel="nofollow">Volver al panel principal</a></h1>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<div class="tools-bar">
							<div class="diet-tools">
								<a class="btn btn-primary create-diet" href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( null ); ?>" rel="nofollow"><span class="text">Nueva dieta</span><?php if( false ) : ?><span class="glyphicon glyphicon-plus"></span><?php endif; ?></a>
							</div>
							<?php EliteTrainerSiteTheme::print_diet_filters(); ?>
						</div>

						<ul class="nav nav-tabs" id="diet-gallery-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#user-diets" aria-controls="user-diets" role="tab" data-toggle="tab">Asignadas</a></li>
							<li role="presentation"><a href="#my-diets-templates" aria-controls="my-diets-templates" role="tab" data-toggle="tab">Mis plantillas</a></li>
							<?php if( $show_preset_diets ) : ?><li role="presentation"><a href="#preset-diets-templates" aria-controls="preset-diets-templates" role="tab" data-toggle="tab">Predefinidas</a></li><?php endif; ?>
						</ul>

						<div class="tab-content" id="training-gallery-tabs-content">

							<div role="tabpanel" class="tab-pane active" id="user-diets">

						<div class="diet-templates">
							<br />
							<p>Aquí tienes todas las dietas asignadas actualmente a tus clientes.</p>
							<div class="table-responsive"><table class="table table-striped items-table">
								<thead><tr>
									<th>Nombre</th>
									<?php if( true ) : ?><th>Para</th><?php endif; ?>
									<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $restrictions as $restriction ) : ?>
<th class="text-center"><?php echo esc_html( $restriction->name ); ?></th>
<?php endforeach; ?>
									<th></th>
								</tr></thead>
								<tbody>
								<?php foreach( EpointPersonalTrainerMapper::get_trainer_assigned_diets( get_current_user_id() ) as $tt ) : ?>
									<?php if( $tt->user ) : ?>
									<tr class="diet-template <?php if( $last_duplicated_diet == $tt->ID ) : ?>new-duplicated<?php endif; ?> <?php if( !$tt->active ) : ?>diet-inactive<?php endif; ?> <?php foreach( $objectives as $objective ) : ?><?php if( EpointPersonalTrainerMapper::is_diet_objective( $tt->ID, $objective->ID ) ) : ?> diet-has-objective-<?php echo esc_attr( $objective->ID ); ?> <?php endif; ?><?php endforeach; ?> <?php foreach( $restrictions as $restriction ) : ?><?php if( EpointPersonalTrainerMapper::is_diet_restriction( $tt->ID, $restriction->ID ) ) : ?> diet-has-restriction-<?php echo esc_attr( $restriction->ID ); ?> <?php endif; ?><?php endforeach; ?>">
	<td class="small-full-width">
		<a class="edit-diet" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a>
		<?php if( true ) : ?><a href="#" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" data-link="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" data-duplicate-link="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>&after=edit" data-toggle="modal" data-target="#confirm-diet-edition" title="Editar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-edition"><?php echo $tt->name; ?></a><?php endif; ?>
	</td>
	<?php if( true ) : ?>
	<td class="small-full-width">
		<?php if( $tt->user ) : ?>
			<?php $client = get_user_by( 'ID', $tt->user ); ?>
			<a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $client->ID ); ?>"><?php echo $client->display_name; ?></a>
		<?php else : ?>
			<span>---</span>
		<?php endif; ?>
	</td>
	<?php endif; ?>
	<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_diet_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $restrictions as $restriction ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_diet_restriction( $tt->ID, $restriction->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $restriction->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
	<td class="actions three">
	<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
		<a class="preview-diet" href="#" data-toggle="modal" data-target="#preview-diet-modal" data-diet="<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
		<a href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" class="edit-diet" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" data-diet="<?php echo $tt->ID; ?>" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
		<?php if( true ) : ?><a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" data-duplicate-link="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>&after=edit" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" data-toggle="modal" data-target="#confirm-diet-edition" title="Editar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-edition"><span class="glyphicon glyphicon-edit"></span></a><?php endif; ?>
		<?php if( true ) : ?><a href="#" data-toggle="modal" data-target="#confirm-diet-duplication" title="Duplicar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-duplication"><span class="glyphicon glyphicon-duplicate"></span></a><?php endif; ?>
		<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>" class="duplicate-diet" data-diet="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a>
		<?php if( true ) : ?><a href="#" data-toggle="modal" data-target="#confirm-diet-deletion" title="Eliminar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-deletion"><span class="glyphicon glyphicon-trash"></span></a><?php endif; ?>
		<a class="delete-diet" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
	<?php endif; ?>
	</td>

									</tr>
									<?php endif; //if( !$tt->user ) ?>
								<?php endforeach; ?>
								</tbody>
							</table></div>
						</div>

							</div><?php //tabs-panel ?>

							<div role="tabpanel" class="tab-pane" id="my-diets-templates">

						<div class="diet-templates">
							<br />
							<p>Aquí tienes todas las dietas creadas o duplicadas desde aquí. También están las duplicadas tras ser asignadas a un cliente.</p>
							<div class="table-responsive"><table class="table table-striped items-table">
								<thead><tr>
									<th>Nombre</th>
									<?php if( false ) : ?><th>Para</th><?php endif; ?>
									<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $restrictions as $restriction ) : ?>
<th class="text-center"><?php echo esc_html( $restriction->name ); ?></th>
<?php endforeach; ?>
									<th></th>
								</tr></thead>
								<tbody>
								<?php foreach( EpointPersonalTrainerMapper::get_trainer_diets( get_current_user_id() ) as $tt ) : ?>
									<?php if( !$tt->user ) : ?>
									<tr class="diet-template <?php if( $last_duplicated_diet == $tt->ID ) : ?>new-duplicated<?php endif; ?> <?php foreach( $objectives as $objective ) : ?><?php if( EpointPersonalTrainerMapper::is_diet_objective( $tt->ID, $objective->ID ) ) : ?> diet-has-objective-<?php echo esc_attr( $objective->ID ); ?> <?php endif; ?><?php endforeach; ?> <?php foreach( $restrictions as $restriction ) : ?><?php if( EpointPersonalTrainerMapper::is_diet_restriction( $tt->ID, $restriction->ID ) ) : ?> diet-has-restriction-<?php echo esc_attr( $restriction->ID ); ?> <?php endif; ?><?php endforeach; ?>">
	<td class="small-full-width">
		<a class="edit-diet" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a>
		<?php if( true ) : ?><a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" data-toggle="modal" data-target="#confirm-diet-edition" title="Editar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-edition"><?php echo $tt->name; ?></a><?php endif; ?>
	</td>
	<?php if( false ) : ?>
	<td class="small-full-width">
		<?php if( $tt->user ) : ?>
			<?php $client = get_user_by( 'ID', $tt->user ); ?>
			<a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $client->ID ); ?>"><?php echo $client->display_name; ?></a>
		<?php else : ?>
			<span>---</span>
		<?php endif; ?>
	</td>
	<?php endif; ?>
	<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_diet_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $restrictions as $restriction ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_diet_restriction( $tt->ID, $restriction->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $restriction->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
	<td class="actions three">
	<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
		<a class="preview-diet" href="#" data-toggle="modal" data-target="#preview-diet-modal" data-diet="<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
		<a href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" class="edit-diet" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" data-diet="<?php echo $tt->ID; ?>" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
		<?php if( true ) : ?><a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" data-toggle="modal" data-target="#confirm-diet-edition" title="Editar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-edition"><span class="glyphicon glyphicon-edit"></span></a><?php endif; ?>
		<?php if( true ) : ?><a href="#" data-toggle="modal" data-target="#confirm-diet-duplication" title="Duplicar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-duplication"><span class="glyphicon glyphicon-duplicate"></span></a><?php endif; ?>
		<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>" class="duplicate-diet" data-diet="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a>
		<?php if( true ) : ?><a href="#" data-toggle="modal" data-target="#confirm-diet-deletion" title="Eliminar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-deletion"><span class="glyphicon glyphicon-trash"></span></a><?php endif; ?>
		<a class="delete-diet" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
	<?php endif; ?>
	</td>

									</tr>
									<?php endif; //if( !$tt->user ) ?>
								<?php endforeach; ?>
								</tbody>
							</table></div>
						</div>

							</div><?php //tabs-panel ?>

							<?php if( $show_preset_diets ) : ?>
							<div role="tabpanel" class="tab-pane" id="preset-diets-templates">
						<div class="diet-templates">
							<br />
							<p>Aquí tienes algunas dietas predefinidas. Puedes utilizarlas o duplicarlas para modificarlas posteriormente.</p>
							<div class="table-responsive"><table class="table table-striped items-table">
								<thead><tr>
									<th>Nombre</th>
									<?php if( false ) : ?><th>Para</th><?php endif; ?>
									<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $restrictions as $restriction ) : ?>
<th class="text-center"><?php echo esc_html( $restriction->name ); ?></th>
<?php endforeach; ?>
									<th></th>
								</tr></thead>
								<tbody>
								<?php foreach( EpointPersonalTrainerMapper::get_preset_diets( get_current_user_id() ) as $tt ) : ?>
									<?php if( !$tt->user ) : ?>
									<tr class="diet-template <?php if( $last_duplicated_diet == $tt->ID ) : ?>new-duplicated<?php endif; ?> <?php foreach( $objectives as $objective ) : ?><?php if( EpointPersonalTrainerMapper::is_diet_objective( $tt->ID, $objective->ID ) ) : ?> diet-has-objective-<?php echo esc_attr( $objective->ID ); ?> <?php endif; ?><?php endforeach; ?> <?php foreach( $restrictions as $restriction ) : ?><?php if( EpointPersonalTrainerMapper::is_diet_restriction( $tt->ID, $restriction->ID ) ) : ?> diet-has-restriction-<?php echo esc_attr( $restriction->ID ); ?> <?php endif; ?><?php endforeach; ?>">
	<td class="small-full-width">
		<a class="edit-diet" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a>
		<?php if( true ) : ?><a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" data-toggle="modal" data-target="#confirm-diet-edition" title="Editar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-edition"><?php echo $tt->name; ?></a><?php endif; ?>
	</td>
	<?php if( false ) : ?>
	<td class="small-full-width">
		<?php if( $tt->user ) : ?>
			<?php $client = get_user_by( 'ID', $tt->user ); ?>
			<a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $client->ID ); ?>"><?php echo $client->display_name; ?></a>
		<?php else : ?>
			<span>---</span>
		<?php endif; ?>
	</td>
	<?php endif; ?>
	<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_diet_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $restrictions as $restriction ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_diet_restriction( $tt->ID, $restriction->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $restriction->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
	<td class="actions three">
	<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
		<a class="preview-diet" href="#" data-toggle="modal" data-target="#preview-diet-modal" data-diet="<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
		<a href="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" class="edit-diet" data-userdiet="<?php echo $tt->user ? 'true' : 'false'; ?>" data-diet="<?php echo $tt->ID; ?>" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
		<?php if( true ) : ?><a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_diet_url( $tt->ID ); ?>" data-toggle="modal" data-target="#confirm-diet-edition" title="Editar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-edition"><span class="glyphicon glyphicon-edit"></span></a><?php endif; ?>
		<?php if( true ) : ?><a href="#" data-toggle="modal" data-target="#confirm-diet-duplication" title="Duplicar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-duplication"><span class="glyphicon glyphicon-duplicate"></span></a><?php endif; ?>
		<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>" class="duplicate-diet" data-diet="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a>
		<?php if( true ) : ?><a href="#" data-toggle="modal" data-target="#confirm-diet-deletion" title="Eliminar" data-diet="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-diet-deletion"><span class="glyphicon glyphicon-trash"></span></a><?php endif; ?>
		<a class="delete-diet" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_DIET_ACTION; ?>&diet=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
	<?php endif; ?>
	</td>

									</tr>
									<?php endif; //if( !$tt->user ) ?>
								<?php endforeach; ?>
								</tbody>
							</table></div>
						</div>
							</div><?php //tabs-panel ?>
							<?php endif; //show_preset_diets ?>

						</div><?php //tabs-content ?>


					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php if( EliteTrainerSiteTheme::must_show_delete_diet_confirmation() ) : ?>
<div class="modal fade" id="confirm-diet-deletion" tabindex="-1" role="dialog" aria-labelledby="confirm-diet-deletion-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-diet-deletion-label">Eliminar dietas</h4>
      </div>
      <div class="modal-body">
			<p>La dieta será eliminada permanentemente. ¿Desea continuar?</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary" data-base-url="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_DIET_ACTION; ?>&diet=" data-diet="">Eliminar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-diet-deletion-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-diet-deletion-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if( EliteTrainerSiteTheme::must_show_duplicate_diet_confirmation() ) : ?>
<div class="modal fade" id="confirm-diet-duplication" tabindex="-1" role="dialog" aria-labelledby="confirm-diet-duplication-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-diet-duplication-label">Duplicar dieta</h4>
      </div>
      <div class="modal-body">
			<p>Esta dieta de duplicará, permitiendote crear una dieta nueva a partir de una antigua.</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary" data-base-url="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_DIET_ACTION; ?>&diet=" data-diet="">Duplicar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-diet-duplication-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-diet-duplication-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if( EliteTrainerSiteTheme::must_show_edit_diet_confirmation() ) : ?>
<div class="modal fade" id="confirm-diet-edition" tabindex="-1" role="dialog" aria-labelledby="confirm-diet-edition-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-diet-edition-label">Editar dieta</h4>
      </div>
      <div class="modal-body">
			<p>A continuación podrá modificar las características de la dieta: nombre, descripción, horarios... ¿Desea continuar?</p>
			<p class="user-text">Ésta es una dieta asignada a un cliente. Las modificaciones que haga aquí, se verán reflejadas en la dieta para el cliente salvo que seleccione la opción &quot;Duplicar&quot;.</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary">Editar</a> <a href="" class="duplicate-link btn btn-primary">Duplicar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-diet-edition-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-diet-edition-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="modal fade" id="preview-diet-modal" tabindex="-1" role="dialog" aria-labelledby="preview-diet-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="preview-diet-modal-label">Previsualizar dieta</h4>
      </div>
      <div class="modal-body">
			<p class="diet"></p>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
(function($){
	$('#preview-diet-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var dietId = button.data('diet');
	  var modal = $(this);

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::GET_DIET_PREVIEW_ACTION; ?>',
				'diet' : dietId
			},
			beforeSend:function(){
				modal.find('.modal-body').html('<p>Cargando...</p>');
			},
			success:function(a,b,c){
				modal.find('.modal-body').html(a);
			},
			error:function(a,b,c){
				modal.find('.modal-body').html('<p>Hubo un error. Inténtelo de nuevo más tarde.</p>');
			}
		});
	});

	$('#confirm-diet-deletion').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var dietId = button.data('diet');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.data('diet',dietId);
	  link.prop('href',link.data('base-url') + dietId);
	});

	$('#confirm-diet-duplication').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var dietId = button.data('diet');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.data('diet',dietId);
	  link.prop('href',link.data('base-url') + dietId);
	});


	$('#confirm-diet-edition').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var dietId = button.data('diet');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.prop('href',button.data('link'));

	  var dLink = modal.find('.modal-body a.duplicate-link');
	  dLink.prop('href',button.data('duplicate-link'));

	  var userDiet = button.data('userdiet');
	  var userText = modal.find('.modal-body p.user-text');
		if( userDiet )
		{
			userText.show();
			dLink.show();
		}
		else
		{
			userText.hide();
			dLink.hide();
		}
	});


	$('#not-show-diet-deletion-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-diet-deletion');
		}
		else
		{
			$('body').addClass('must-confirm-diet-deletion');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'diet_deletion',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
		});
	});

	$('#not-show-diet-duplication-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-diet-duplication');
		}
		else
		{
			$('body').addClass('must-confirm-diet-duplication');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'diet_duplication',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
			complete:function(){
			},
			success: function(a,b,c){
			}
		});
	});


	$('#not-show-diet-edition-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-diet-edition');
		}
		else
		{
			$('body').addClass('must-confirm-diet-edition');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'diet_edition',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
		});
	});

})(jQuery);
</script>


<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
