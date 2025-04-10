<?php defined( 'ABSPATH' ) or die( "Wrong access" );
$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$user = wp_get_current_user();
 ?>
<div class="modal fade" id="assign-training-modal" tabindex="-1" role="dialog" aria-labelledby="assign-training-modal-label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="assign-training-modal-label">Asignar entrenamiento</h4>
      </div>
      <div class="modal-body">
<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
<div class="row">
	<div class="col-xs-12">
		<p>Selecciona las fechas entre las cuales quieres asignar el entrenamiento y después haz clic sobre el entrenamiento que quieras asignar.</p>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label>Desde</label>
			<input type="date" class="form-control training-start-input" />
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="form-group">
			<label>Hasta</label>
			<input type="date" class="form-control training-end-input" />
		</div>
	</div>
</div>

						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#user-training" aria-controls="user-training" role="tab" data-toggle="tab">Asignados</a></li>
							<li role="presentation"><a href="#my-training-templates" aria-controls="my-training-templates" role="tab" data-toggle="tab">Mis plantillas</a></li>
							<li role="presentation"><a href="#preset-training-templates" aria-controls="preset-training-templates" role="tab" data-toggle="tab">Predefinidos</a></li>
						</ul>

						<div class="tab-content">

							<div role="tabpanel" class="tab-pane active" id="user-training">
								<div class="training-templates">
								<?php $training_templates = EpointPersonalTrainerMapper::get_trainer_assigned_training( $user->ID ); ?>

									<div class="table-responsive"><table class="table table-striped items-table">
										<thead><tr>
											<th>Nombre</th>
											<th>Para</th>
											<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<th class="text-center"><?php echo esc_html( $environment->name ); ?></th>
<?php endforeach; ?>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $training_templates as $tt ) : ?>
											<tr>
			<td class="small-full-width"><a href="#" class="assign-training" data-training="<?php echo $tt->ID; ?>" data-member="<?php echo $member_id; ?>"><?php echo $tt->name; ?></a></td>

			<td class="small-full-width">
				<?php $client = get_user_by( 'ID', $tt->user ); ?>
				<a href="#"><?php echo $client->display_name; ?></a>
			</td>
			<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
			<td class="actions">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="my-training-templates">
								<div class="training-templates">
								<?php $training_templates = EpointPersonalTrainerMapper::get_trainer_training_templates( $user->ID ); ?>

									<div class="table-responsive"><table class="table table-striped items-table">
										<thead><tr>
											<th>Nombre</th>
											<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<th class="text-center"><?php echo esc_html( $environment->name ); ?></th>
<?php endforeach; ?>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $training_templates as $tt ) : ?>
											<tr>
			<td class="small-full-width"><a href="#" class="assign-training" data-training="<?php echo $tt->ID; ?>" data-member="<?php echo $member_id; ?>"><?php echo $tt->name; ?></a></td>
			<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
			<td class="actions">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="preset-training-templates">
								<div class="training-templates">
								<?php $training_templates = EpointPersonalTrainerMapper::get_preset_training_items(); ?>
									<div class="table-responsive"><table class="table table-striped items-table">
										<thead><tr>
											<th>Nombre</th>
											<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<th class="text-center"><?php echo esc_html( $environment->name ); ?></th>
<?php endforeach; ?>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $training_templates as $tt ) : ?>
											<tr>
			<td class="small-full-width"><a href="#" class="assign-training" data-training="<?php echo $tt->ID; ?>" data-member="<?php echo $member_id; ?>"><?php echo $tt->name; ?></a></td>
			<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
			<td class="actions">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>
						</div>



<?php endif; ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){

$(document).ready(function(){

	$('#assign-training-modal a.assign-training').click(function(evt){

		evt.preventDefault();
		var t = $(evt.currentTarget);
		var training = t.data('training');
		var member = t.data('member');

		var startInput = $('.training-start-input');
		var endInput = $('.training-end-input');

		if( startInput.val() == '' )
		{
			startInput.focus();
			startInput.closest('.form-group').addClass('has-error');
			return;
		}
		if( endInput.val() == '' )
		{
			endInput.focus();
			endInput.closest('.form-group').addClass('has-error');
			return;
		}

		var postData = {
			'action':'<?php echo EliteTrainerSiteTheme::ASSIGN_TRAINING_ACTION; ?>',
			'training': training,
			'member': member,
			'start': startInput.val(),
			'end': endInput.val()
		};

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: postData,
			//contentType: false,
			//processData: false,
			complete:function(){
				//cc.removeClass('loading');
				$('div.modal').modal('hide');
			},
			success: function(a,b,c){

				var r = JLCCustomForm.parseWPAjax(a);

				$('.assigned-training-table tbody').append(r[0].data);
			},
			error: function(a,b,c)
			{
				alert('Hubo un error');
			}
		});


	});
});

})(jQuery);
</script>
