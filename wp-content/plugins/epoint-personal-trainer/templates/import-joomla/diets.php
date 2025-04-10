<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import diets from Joomla', EpointPersonalTraining::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<?php if( !empty( $diets ) ) : ?>
	<p><?php echo esc_html( sprintf( __( 'There are %d diets.', EpointPersonalTraining::TEXT_DOMAIN ), count( $diets ) ) ); ?></p>
	<p><a class="button button-primary" href="<?php echo $page_slug . '&action=import-diets'; ?>"><?php echo esc_html( __( 'Import all', EpointPersonalTraining::TEXT_DOMAIN ) ); ?></a></p>
	<table><tbody>
		<?php foreach( $diets as $diet ) : ?>
		<tr>
			<td><?php echo esc_html( $diet->id ); ?></td>
			<td><?php echo esc_html( $diet->nombre ); ?></td>
			<td><?php echo esc_html( $diet->ordering ); ?></td>
			<td><?php echo esc_html( $diet->activo ); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody></table>
	<?php else : ?>
		<p><?php echo esc_html( __( 'No diets found', EpointPersonalTraining::TEXT_DOMAIN ) ); ?></p>
	<?php endif; ?>
	
</div>
