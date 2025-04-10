<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<h3><?php echo esc_html( $training->name ); ?></h3>
<p><strong>Objetivos:</strong> <?php echo esc_html( implode( ', ', $objectives_names ) ); ?></p>
<p><strong>Entornos:</strong> <?php echo esc_html( implode( ', ', $environments_names ) ); ?></p>
<?php if( false && !empty( $training->description ) ) : ?>
	<hr />
	<div class="description">
		<?php echo wp_kses_post( $training->description ); ?>
	</div>
<?php endif; ?>
<?php if( !empty( $training->observations ) ) : ?>
	<hr />
	<div class="observations">
		<h4>Observaciones</h4>
		<?php echo wp_kses_post( $training->observations ); ?>
	</div>
<?php endif; ?>
<hr />
<div class="exercises">
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
					<div class="ex-data">
						<table class="table">
							<tr>
			<td align="center"><img src="<?php echo EliteTrainerSiteTheme::get_exercise_image( $ex['exercise'], 'start', 'thumbnail' );  ?>" style="max-width:100%;" /></td>
			<td align="center"><img src="<?php echo EliteTrainerSiteTheme::get_exercise_image( $ex['exercise'], 'end', 'thumbnail' );  ?>" style="max-width:100%;" /></td>
							</tr>
						</table>
						<table class="table">
							<tr>
								<th>Series</th>
								<th>Repeticiones</th>
								<th>Cargas</th>
							</tr>
							<tr>
								<td><?php echo esc_html( $ex['current']->series ); ?></td>
								<td><?php echo esc_html( $ex['current']->repetitions ); ?></td>
								<td><?php echo esc_html( $ex['current']->loads ); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
<?php endforeach; ?>
</div>

