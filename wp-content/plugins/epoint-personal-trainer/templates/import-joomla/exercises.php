<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php _e( 'Import exercises from Joomla', EpointPersonalTrainer::TEXT_DOMAIN ); ?>
	</h1>
	<hr class="wp-header-end" />
	<?php if( !empty( $exercises ) ) : ?>
	<p><?php echo esc_html( sprintf( __( 'There are %d exercises.', EpointPersonalTrainer::TEXT_DOMAIN ), count( $exercises ) ) ); ?></p>
	<p><a class="button button-primary" href="<?php echo $page_slug . '&action=import-exercises'; ?>"><?php echo esc_html( __( 'Import all', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></a></p>
	<table><tbody>
		<?php foreach( $exercises as $exercise ) : ?>
		<?php $exists = EpointPersonalTrainerMapper::get_exercise_by_name( trim( $exercise->nombre ) ); ?>
		<tr <?php if( $exists ) : ?>style="color:#888;"<?php endif; ?>>
			<td><?php echo esc_html( $exercise->id ); ?></td>
			<td><?php echo esc_html( $exercise->nombre ); ?></td>
			<td><?php echo esc_html( $exercise->video ); ?></td>
			<td><?php echo mb_substr( esc_html( $exercise->descripcion ), 0, 40 ); ?></td>
			<td><?php echo esc_html( $exercise->imagen1 ); ?></td>
			<td><?php echo esc_html( $exercise->imagen2 ); ?></td>
			<td><?php echo esc_html( $exercise->ordering ); ?></td>
			<td><?php echo esc_html( $exercise->activo ); ?></td>
			<td><?php echo esc_html( $exercise->cat_title ); ?></td>
			<td>
				<?php $corrections = array(); ?>
				<?php $corr_data = unserialize( base64_decode( $exercise->correcciones ) ); ?>
				<?php if( is_array( $corr_data ) ) : ?>
					<ul>
					<?php foreach( $corr_data as $correction ) : ?>
						<li <?php if( isset( $correction['imagen1'] ) ) : ?>style="color:#0f0;"<?php endif; ?>><?php echo esc_html( $correction['desc'] ); ?></li>	
					<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody></table>
	<?php else : ?>
		<p><?php echo esc_html( __( 'No exercises found', EpointPersonalTrainer::TEXT_DOMAIN ) ); ?></p>
	<?php endif; ?>
	
</div>
