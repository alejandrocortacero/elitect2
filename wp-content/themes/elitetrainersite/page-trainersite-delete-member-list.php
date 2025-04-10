<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
					

						<h1>Gestionar bajas<button class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target="#member-filter-layer" aria-expanded="false" aria-controls="member-filter-layer">Filtrar</button></h1>
						<div class="collapse" id="member-filter-layer">
							<?php echo EpointPersonalTrainerPublic::get_delete_members_filter_form(); ?>
						</div>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<?php $users = get_users( array(
							'role' => EpointPersonalTrainer::SPORTSMAN_ROLE
						) ); ?>
						<div class="member-search-results">
							<?php $table_template = locate_template( 'templates/members/delete-members-table.php' ); ?>
							<?php if( $table_template ) include( $table_template ); ?>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php //get_template_part( 'templates/contact', 'container' ); ?>


<div class="modal fade" id="delete-member-modal" tabindex="-1" role="dialog" aria-labelledby="delete-member-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="delete-member-modal-label">Dar de baja</h4>
      </div>
      <div class="modal-body">
			<p>¿Está seguro? (Su cliente desaparecerá de los archivos)</p>
			<p class="text-center">
				<button class="btn btn-danger confirm-delete-member">Sí</button>
				<button class="btn btn-primary close-modal" onclick="jQuery('#delete-member-modal').modal('hide');">No</button>
			</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deactivate-member-modal" tabindex="-1" role="dialog" aria-labelledby="deactivate-member-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deactivate-member-modal-label">Dar de baja</h4>
      </div>
      <div class="modal-body">
			<p>¿Está seguro? (Su cliente dejará de tener acceso al perfil)</p>
			<p class="text-center">
				<button class="btn btn-danger confirm-deactivate-member">Sí</button>
				<button class="btn btn-primary close-modal" onclick="jQuery('#deactivate-member-modal').modal('hide');">No</button>
			</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reactivate-member-modal" tabindex="-1" role="dialog" aria-labelledby="reactivate-member-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="reactivate-member-modal-label">Dar de baja</h4>
      </div>
      <div class="modal-body">
			<p>¿Está seguro? (Su cliente volverá a tener acceso al perfil)</p>
			<p class="text-center">
				<button class="btn btn-danger confirm-reactivate-member">Sí</button>
				<button class="btn btn-primary close-modal" onclick="jQuery('#reactivate-member-modal').modal('hide');">No</button>
			</p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
(function($){
	$(document).ready(function(){
		$('#delete-member-modal').on('show.bs.modal', function(evt){
			var b = $(evt.relatedTarget);
			var member = b.data('member');
			var modal = $(this);

			modal.find('.confirm-delete-member').data('member', member);
		});

		$('#deactivate-member-modal').on('show.bs.modal', function(evt){
			var b = $(evt.relatedTarget);
			var member = b.data('member');
			var modal = $(this);

			modal.find('.confirm-deactivate-member').data('member', member);
		});

		$('#reactivate-member-modal').on('show.bs.modal', function(evt){
			var b = $(evt.relatedTarget);
			var member = b.data('member');
			var modal = $(this);

			modal.find('.confirm-reactivate-member').data('member', member);
		});
	});
})(jQuery);
</script>

<?php get_footer( 'noclose' ); ?>
