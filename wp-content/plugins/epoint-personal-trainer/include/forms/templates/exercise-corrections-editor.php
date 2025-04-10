<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="exercise-corrections-editor">
	<p><a class="btn btn-primary add-exercise-correction">Añadir corrección</a></p>
	<div class="corrections-list">
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
	</div>
</div>
