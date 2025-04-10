<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import food from Joomla', EpointPersonalTraining::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<?php if( !empty( $food ) ) : ?>
	<p><?php echo esc_html( sprintf( __( 'There are %d food items.', EpointPersonalTraining::TEXT_DOMAIN ), count( $food ) ) ); ?></p>
	<p><a class="button button-primary" href="<?php echo $page_slug . '&action=import-food'; ?>"><?php echo esc_html( __( 'Import all', EpointPersonalTraining::TEXT_DOMAIN ) ); ?></a></p>
	<table><tbody>
		<?php foreach( $food as $food_item ) : ?>
		<tr>
			<td><?php echo esc_html( $food_item->id ); ?></td>
			<td><?php echo esc_html( $food_item->nombre ); ?></td>
			<td><?php echo esc_html( $food_item->ordering ); ?></td>
			<td><?php echo esc_html( $food_item->activo ); ?></td>
			<td><?php echo esc_html( $food_item->cat_title ); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody></table>
	<?php else : ?>
		<p><?php echo esc_html( __( 'No food found', EpointPersonalTraining::TEXT_DOMAIN ) ); ?></p>
	<?php endif; ?>
	
</div>
