<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<p><a class="btn btn-primary assign-training" href="#" rel="nofollow" data-toggle="modal" data-target="#assign-training-modal">Asignar entrenamiento</a></p>
		<?php //add_action( 'wp_footer', function(){ include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'assign-training-modal.php' ) ) ); } ); ?>
	<?php $training_items = EpointPersonalTrainerMapper::get_user_training_items( $member_id, null, null, 'start', 'ASC' ); ?>
	<div class="table-responsive"><table class="table table-striped assigned-training-table items-table">
		<thead><tr>
			<th>Nombre</th>
			<th>Desde</th>
			<th>Hasta</th>
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
		<?php $row_template = implode( DIRECTORY_SEPARATOR, array( __DIR__, 'assigned-training-row.php' ) ); ?>
		<?php foreach( $training_items as $tt ) : ?>
			<?php include( $row_template ); ?>
		<?php endforeach; ?>
		</tbody>
	</table></div>

