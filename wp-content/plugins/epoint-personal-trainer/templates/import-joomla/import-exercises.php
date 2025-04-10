<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import exercises from Joomla', EpointPersonalTrainer::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<?php if( !empty( $exercises ) ) : ?>
		<p><?php echo esc_html( sprintf( __( 'There are %d exercises.', EpointPersonalTrainer::TEXT_DOMAIN ), count( $exercises ) ) ); ?></p>
		<p><?php echo esc_html( sprintf( __( 'Categories created: %s', EpointPersonalTrainer::TEXT_DOMAIN ), implode( ', ', $created_categories ) ) ); ?></p>
		<p><?php echo esc_html( sprintf( __( 'Failed categories: %s', EpointPersonalTrainer::TEXT_DOMAIN ), implode( ', ', $failed_categories ) ) ); ?></p>
		<p><?php echo esc_html( sprintf( __( 'Omitted categories: %s', EpointPersonalTrainer::TEXT_DOMAIN ), implode( ', ', $omitted_categories ) ) ); ?></p>
		<?php $imported = array(); ?>
		<?php foreach( $results as $old_id => $new_id ) : ?>
			<?php if( $new_id ) : ?>
				<?php $imported[] = $new_id; ?>
				<p><?php echo esc_html( sprintf( __( 'Exercise %d imported as exercise %d', EpointPersonalTrainer::TEXT_DOMAIN ), (int)$old_id, (int)$new_id ) ); ?></p>
			<?php else : ?>
				<p style="color:#f00;"><?php echo esc_html( sprintf( __( 'Exercise %d has not been imported', EpointPersonalTrainer::TEXT_DOMAIN ), (int)$old_id ) ); ?></p>
			<?php endif; ?>
		<?php endforeach; ?>
		<p><?php echo esc_html( sprintf( __( '%d of %d exercises imported successfuly.', EpointPersonalTrainer::TEXT_DOMAIN ), count( $imported ), count( $exercises ) ) ); ?></p>
	<?php else : ?>
		<p><?php echo esc_html( __( 'No exercise found', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></p>
	<?php endif ?>
	
</div>
