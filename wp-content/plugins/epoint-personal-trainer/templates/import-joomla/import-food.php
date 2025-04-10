<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import food from Joomla', EpointPersonalTraining::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<?php if( !empty( $food ) ) : ?>
		<p><?php echo esc_html( sprintf( __( 'There are %d food elements.', EpointPersonalTraining::TEXT_DOMAIN ), count( $food ) ) ); ?></p>
		<p><?php echo esc_html( sprintf( __( 'Categories created: %s', EpointPersonalTraining::TEXT_DOMAIN ), implode( ', ', $created_categories ) ) ); ?></p>
		<p><?php echo esc_html( sprintf( __( 'Failed categories: %s', EpointPersonalTraining::TEXT_DOMAIN ), implode( ', ', $failed_categories ) ) ); ?></p>
		<p><?php echo esc_html( sprintf( __( 'Omitted categories: %s', EpointPersonalTraining::TEXT_DOMAIN ), implode( ', ', $omitted_categories ) ) ); ?></p>
		<?php $imported = array(); ?>
		<?php foreach( $results as $old_id => $new_id ) : ?>
			<?php if( $new_id ) : ?>
				<?php $imported[] = $new_id; ?>
				<p><?php echo esc_html( sprintf( __( 'Food %d imported as food %d', EpointPersonalTraining::TEXT_DOMAIN ), (int)$old_id, (int)$new_id ) ); ?></p>
			<?php else : ?>
				<p style="color:#f00;"><?php echo esc_html( sprintf( __( 'Food %d has not been imported', EpointPersonalTraining::TEXT_DOMAIN ), (int)$old_id ) ); ?></p>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php else : ?>
		<p><?php echo esc_html( __( 'No food found', EpointPersonalTraining::TEXT_DOMAIN ) ); ?></p>
	<?php endif ?>
	
</div>
