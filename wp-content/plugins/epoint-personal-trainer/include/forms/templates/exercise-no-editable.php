<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="exercise-no-editable">
	<div class="name">
		<h2><?php echo esc_html( $exercise->name ); ?> (<?php echo implode( ', ', $category_names ); ?>)</h2>
	</div>
	<div class="images">
		<figure>
			<img src="<?php echo EpointPersonalTrainer::get_exercise_image( $exercise, 'start' ); ?>" alt="Inicio" />
			<figcaption>Inicio</figcaption>
		</figure>
		<figure>
			<img src="<?php echo EpointPersonalTrainer::get_exercise_image( $exercise, 'end' ); ?>" alt="Fin" />
			<figcaption>Fin</figcaption>
		</figure>
	</div>
	<div class="video">
		<?php if( $exercise->video ) echo EpointPersonalTrainer::get_video_iframe_from_link( $exercise->video ); ?>
	</div>
	<div class="description">
		<?php echo wp_kses_post( $exercise->description ); ?>
	</div>
	<?php if( false ) : ?>
		<div class="exercise-corrections">
		<?php if( is_array( $corrections ) ) : ?>
			<?php foreach( $corrections as $c ) : ?>
			<div class="correction">
				<div class="description">
					<?php echo wp_kses_post( $c->description ); ?>
				</div>
				<figure>
					<img src="<?php echo EpointPersonalTrainer::get_exercise_correction_image( $c, 'image_well' ); ?>" alt="Bien" />
					<figcaption>Bien</figcaption>
				</figure>
				<figure>
					<img src="<?php echo EpointPersonalTrainer::get_exercise_correction_image( $c, 'image_bad' ); ?>" alt="Mal" />
					<figcaption>Mal</figcaption>
				</figure>
			</div>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
