<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<h3 style="margin-top:0;"><?php echo esc_html( $diet->name ); ?></h3>
<p><strong>Objetivos:</strong> <?php echo esc_html( implode( ', ', $objectives_names ) ); ?></p>
<p><strong>Restricciones:</strong> <?php echo esc_html( implode( ', ', $restrictions_names ) ); ?></p>
<?php if( !empty( $diet->description ) ) : ?>
	<hr />
	<div class="description">
		<h4>Descripción</h4>
		<?php echo wp_kses_post( $diet->description ); ?>
	</div>
<?php endif; ?>
<?php if( !empty( $diet->observations ) ) : ?>
	<hr />
	<div class="observations">
		<h4>Observaciones</h4>
		<?php echo wp_kses_post( $diet->observations ); ?>
	</div>
<?php endif; ?>
<div class="intervals">
<?php $intervals = EpointPersonalTrainerMapper::get_diet_intervals( $diet->ID ); ?>
<?php $indexes = array( 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,0,1,2,3); ?>
<?php foreach( $indexes as $ind ) : ?>
	<?php if( !empty( $intervals[$ind] ) ) : ?>
	<?php $interval = $intervals[$ind]; ?>
		<?php if( !empty( $interval->food ) && !empty( $interval->description ) ) : ?>
		<div class="interval">
			<hr />
			<p><strong><?php echo sprintf( '%02d:00', $ind ); ?></strong> <?php if( !empty( $interval->food ) ) : ?>(<?php echo implode( ', ', array_map( function($a) { return EpointPersonalTrainerMapper::get_food( $a )->name; }, $interval->food ) ); ?>)<?php endif; ?></p>
			<p><?php echo $interval->description; ?></p>
			<hr />
		</div>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>

</div>
