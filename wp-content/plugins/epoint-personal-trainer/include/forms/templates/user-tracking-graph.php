<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
// this is unused
?>
<?php //$this->print_section_header(); ?>
<h2><?php echo esc_html( __( 'Progress graphics', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></h2>
<?php if( empty( $parts ) ) : ?>
	<h3><?php echo esc_html( sprintf( __( 'Graphs will be available when you have introduced your tracking data %d times or more.', EpointPersonalTrainer::TEXT_DOMAIN ), EpointPersonalTrainer::MIN_USER_TRACKING_ROWS ) ); ?></h3>
<?php else : ?>
	<div class="row equal-height">
	<?php foreach( $parts as $part ) : ?>
		<div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4 part-graph">
			<div id="part-<?php echo $part; ?>" style="width:600px; height:400px;max-width:100%;"></div>
		</div>
	<?php endforeach; ?>
	</div>
<?php endif; ?>
<?php if( false && !empty( $rows ) ) : ?>
<h3><?php echo esc_html( __( 'Previous data', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></h3>
<div class="table-responsive">
	<table class="table">
		<thead><tr>
			<th><?php echo esc_html( __( 'Date', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Weight (kg)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Biceps (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Shoulder (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Chest (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Waist (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Hip (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Thigh (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Leg (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
			<th><?php echo esc_html( __( 'Calf (cm)', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></th>
		</tr></thead>
		<tbody>
		<?php foreach( $rows as $row ) : ?>
			<tr>
				<td><?php echo esc_html( $row->saved ); ?></td>
				<td><?php echo esc_html( $row->weight ); ?></td>
				<td><?php echo esc_html( $row->biceps ); ?></td>
				<td><?php echo esc_html( $row->shoulder ); ?></td>
				<td><?php echo esc_html( $row->chest ); ?></td>
				<td><?php echo esc_html( $row->waist ); ?></td>
				<td><?php echo esc_html( $row->hip ); ?></td>
				<td><?php echo esc_html( $row->thigh ); ?></td>
				<td><?php echo esc_html( $row->leg ); ?></td>
				<td><?php echo esc_html( $row->calf ); ?></td>
			</tr>
			<tr>
				<td colspan="10"><strong><?php echo esc_html( __( 'Observations:', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></strong> <?php echo nl2br( esc_html( $row->observations ) ); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php endif; ?>
