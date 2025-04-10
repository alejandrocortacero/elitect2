<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<?php foreach( $categories as $cat_id => $cat_info ) : ?>
	<div class="cat-layer" data-cat-id="<?php echo esc_attr( $cat_id ); ?>">
		<div class="cat-position-controls">
			<div class="move move-up"><span class="glyphicon glyphicon-chevron-up"></span></div>
			<div class="move move-down"><span class="glyphicon glyphicon-chevron-down"></span></div>
		</div>
		<div class="content">
			<p><?php echo esc_html( $cat_info['name'] ); ?></p>
			<?php foreach( $exercises_data as $e ) : ?>
				<?php if( in_array( $e->ID, $cat_info['exercises'] ) ) : ?>
					<?php include( __DIR__ . DIRECTORY_SEPARATOR . 'training-exercise-inputs.php' ); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endforeach; ?>
