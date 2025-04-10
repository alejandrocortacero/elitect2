<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import diets from Joomla', EpointPersonalTraining::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<?php if( !empty( $diets ) ) : ?>
		<p><?php echo esc_html( sprintf( __( 'There are %d diets.', EpointPersonalTraining::TEXT_DOMAIN ), count( $diets ) ) ); ?></p>
		<?php $imported = array(); ?>
		<?php foreach( $results as $old_id => $new_id ) : ?>
			<?php if( $new_id ) : ?>
				<?php $imported[] = $new_id; ?>
				<p><?php echo esc_html( sprintf( __( 'Diet %d imported as diet %d', EpointPersonalTraining::TEXT_DOMAIN ), (int)$old_id, (int)$new_id ) ); ?></p>
			<?php else : ?>
				<p style="color:#f00;"><?php echo esc_html( sprintf( __( 'Diet %d has not been imported', EpointPersonalTraining::TEXT_DOMAIN ), (int)$old_id ) ); ?></p>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php else : ?>
		<p><?php echo esc_html( __( 'No diets found', EpointPersonalTraining::TEXT_DOMAIN ) ); ?></p>
	<?php endif ?>
	
</div>
