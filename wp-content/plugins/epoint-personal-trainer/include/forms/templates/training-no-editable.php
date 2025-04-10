<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="training-no-editable">
	<p class="objectives"><strong>Objetivos:</strong> <?php echo esc_html( implode( ', ', $objectives_names ) ); ?></p>
	<p class="environments"><strong>Entornos:</strong> <?php echo esc_html( implode( ', ', $environments_names ) ); ?></p>
	<?php if( false && !empty( $training->description ) ) : ?>
		<hr />
		<div class="description">
			<?php echo wp_kses_post( $training->description ); ?>
		</div>
	<?php endif; ?>
	<?php if( !empty( $training->observations ) ) : ?>
		<hr />
		<div class="description">
			<?php echo wp_kses_post( $training->observations ); ?>
		</div>
	<?php endif; ?>
	<?php if( !empty( $training->video ) ) : ?>
	<div class="video-layer">
		<p class="text-center"><a href="<?php echo esc_attr( $training->video ); ?>" rel="external" target="_blank" class="btn btn-primary">Vídeo del entrenamiento</a></p>
	</div>
	<?php endif; ?>

	<div class="exercises">
		<h2 class="text-center">Ejercicios</h2>
	<?php foreach( $exercise_categories as $cat ) : ?>
		<div class="exercise-category">
			<h3><?php echo esc_html( $cat['name'] ); ?></h3>
			<div class="category-exercises">
			<?php foreach( $cat['exercises'] as $ex_id => $ex ) : ?>
				<div class="exercise" data-exercise="<?php echo esc_attr( $ex_id ); ?>">
					<div class="basic">
						<div class="name">
							<p><strong><?php echo esc_html( $ex['exercise']->name ); ?></strong></p>
							<?php if( !empty( $ex['current']->description ) ) : ?>
								<div class="training-exercise-description">
									<?php echo wp_kses_post( $ex['current']->description ); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="data">
							<div class="current">
								<div class="series"><p><strong>Series</strong></p><p><?php echo esc_html( $ex['current']->series ); ?></p></div>
								<div class="repetitions"><p><strong>Repeticiones</strong></p><p><?php echo esc_html( $ex['current']->repetitions ); ?></p></div>
								<div class="loads"><p><strong>Cargas</strong></p><p><?php echo esc_html( $ex['current']->loads ); ?></p></div>
							</div>
						</div>
					</div>
					<div class="details">
						<div class="images">
							<img src="<?php echo EliteTrainerSiteTheme::get_exercise_image( $ex['exercise'], 'start' ); ?>"  alt="Inicio" />
							<img src="<?php echo EliteTrainerSiteTheme::get_exercise_image( $ex['exercise'], 'end' ); ?>"  alt="fin" />
						</div>
						<div class="description">
							<?php echo wp_kses_post( $ex['exercise']->description ); ?>
						</div>
						<?php if( !empty( $ex['exercise']->video ) ) : ?>
						<div class="video-layer">
							<p class="text-center"><a href="<?php echo esc_attr( $ex['exercise']->video ); ?>" rel="external" target="_blank" class="btn btn-primary">Vídeo del ejercicio completo</a></p>
						</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>

</div>
