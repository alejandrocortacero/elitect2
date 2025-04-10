<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php if( !empty( $magnitudes ) && class_exists( 'EpointPersonalTrainer', false ) ) : ?>
		<h2 class="text-center"><?php echo esc_html( $types_titles[$type] ); ?></h2>
		<div class="row <?php echo $type; ?>-measures-row">
			<div class="col-xs-12">
				<div class="section-text">
					<div class="editable">
						<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( $types_content[$type]['key'], $types_content[$type]['content'] ) ); ?>
					</div>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( $types_content[$type]['key'] ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( $type . 'measuresheaderimage' ); ?>
			</div>
		</div>
	<?php if( !empty( $dates ) ) : ?>
		<div class="table-responsive">
			<table class="table table-striped">
				<tbody>
					<thead><tr>
						<th>Fecha</th>
					<?php foreach( $magnitudes as $magnitude ) : ?>
						<th><?php echo esc_html( $magnitude->name ); ?></th>
					<?php endforeach; ?>
					
					</tr></thead>
				<?php foreach( $dates as $date => $measures ) : ?>
					<tr>
						<td><?php echo esc_html( date( 'd/m/Y', strtotime( $date ) ) ); ?></td>
					<?php foreach( $magnitudes as $magnitude ) : ?>
						<td><?php echo isset( $measures[(int)$magnitude->ID] ) ?  esc_html( $measures[(int)$magnitude->ID]['value'] ) : '---'; ?> <?php if( !empty( $measures[(int)$magnitude->ID]['observations'] ) ) : ?><button type="button" class="btn btn-sm" data-toggle="popover" title="Observaciones" data-container="body" data-content="<?php echo esc_attr( $measures[(int)$magnitude->ID]['observations'] ); ?>"><span class="glyphicon glyphicon-eye-open"></span></button><?php endif; ?></td>
					<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	<?php else : ?>
		<p>No se han registrado mediciones de estas pruebas aun.</p>
	<?php endif; ?>

	<hr />
	<?php echo EpointPersonalTrainerPublic::get_member_physical_test_form( $member_id, $type, $trainer_id ); ?>

<?php endif; ?>
