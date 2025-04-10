<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="exercise <?php if( !$exercise->active ) : ?>inactive<?php endif; ?>" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>">
	<?php $image_start = TrainerSiteTheme::get_exercise_image( $exercise->image_start ); ?>
	<?php $image_end = TrainerSiteTheme::get_exercise_image( $exercise->image_end ); ?>
	<div class="images">
		<div class="image-start" style="background-image:url('<?php echo $image_start; ?>');"></div>
		<div class="image-end" style="background-image:url('<?php echo $image_end; ?>');"></div>
	</div>
	<div class="title">
		<p><?php echo esc_html( $exercise->name ); ?></p>
	</div>
</div>
