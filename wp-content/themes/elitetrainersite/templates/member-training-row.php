<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php $is_training_active = EpointPersonalTrainerMapper::is_training_active( $tt->ID ); ?>

<?php if( EliteTrainerSiteTheme::is_site_trainer() || $is_training_active ) : ?>
<div class="row training-row <?php if( $is_training_active ) : ?>training-active<?php else : ?>training-inactive<?php endif; ?>" data-training="<?php echo esc_attr( $tt->ID ); ?>">
	<div class="col-xs-12 col-sm-4 training-col">
		<div class="training-col-content">
			<p><span class="glyphicon glyphicon-calendar"></span> Desde <span class="date"><?php echo esc_html( strftime( '%d/%m/%y', strtotime( $tt->start ) ) ); ?></span></p>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 training-col training-col-2">
		<div class="training-col-content training-col-content-2">
			<p><span class="glyphicon glyphicon-calendar"></span> Hasta <span class="date"><?php echo esc_html( strftime( '%d/%m/%y', strtotime( $tt->end ) ) ); ?></span></p>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 training-col">
		<a href="#training-info-col-<?php echo esc_attr( $tt->ID ); ?>" data-toggle="collapse"  role="button">
			<div class="training-col-content">
				<p><span class="glyphicon glyphicon-chevron-right"></span> Ver Entrenamiento</p>
				<p class="training-name"><?php echo esc_html( $tt->name ); ?></p>
			</div>
		</a>
	</div>
	<div class="col-xs-12 training-col training-info-col"><div class="training-info-col-content collapse" id="training-info-col-<?php echo esc_attr( $tt->ID ); ?>">
		<div class="actions">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a class="training-button edit-training" href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
				<button class="training-button remove-training"><span class="glyphicon glyphicon-trash"></span> Quitar</button>
				<a class="training-button hide-training" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::HIDE_TRAINING_ACTION; ?>&training=<?php echo esc_attr( $tt->ID ); ?>" data-active="<?php echo $is_training_active ? 'true' : 'false'; ?>"><span class="glyphicon glyphicon-eye-open"></span> <?php if( $is_training_active ) : ?>Ocultar<?php else : ?>Mostrar<?php endif; ?></a>
			<?php endif; ?>
			<button class="training-button" data-toggle="collapse" data-target="#training-info-col-<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
		</div>
		<h3><?php echo esc_html( $tt->name ); ?></h3>
		<?php $objectives_names = EpointPersonalTrainerMapper::get_training_objectives_names( $tt->ID ); ?>
		<p><strong>Objetivos:</strong> <?php echo esc_html( implode( ', ', $objectives_names ) ); ?></p>
		<?php $environments_names = EpointPersonalTrainerMapper::get_training_environments_names( $tt->ID ); ?>	
		<p><strong>Entornos:</strong> <?php echo esc_html( implode( ', ', $environments_names ) ); ?></p>
		<?php $exercise_categories = EpointPersonalTrainer::get_training_exercises_categorized( $tt->ID ); ?>
		<?php if( false && !empty( $tt->description ) ) : ?>
			<hr />
			<div class="description">
				<?php echo wp_kses_post( $tt->description ); ?>
			</div>
		<?php endif; ?>
		<?php if( !empty( $tt->video ) ) : ?>
			<?php if( false ) : ?><p class="text-center"><a href="<?php echo esc_attr( $tt->video ); ?>" rel="external" target="_blank" class="btn btn-primary">Vídeo del entrenamiento</a></p><?php endif; ?>
			<div class="video-layer" style="position:relative">
				<div class="video">
					<?php echo wp_kses( EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( $tt->video ), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if( !empty( $tt->observations ) ) : ?>
			<hr />
			<div class="observations">
				<h4>Observaciones</h4>
				<?php echo wp_kses_post( $tt->observations ); ?>
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
							<div class="data">
								<div class="current">
									<div class="series"><p><strong>Series</strong></p><p><?php echo esc_html( $ex['current']->series ); ?></p></div>
									<div class="repetitions"><p><strong>Repeticiones</strong></p><p><?php echo esc_html( $ex['current']->repetitions ); ?></p></div>
									<div class="loads" data-exercise="<?php echo esc_attr( $ex_id ); ?>" data-training="<?php echo esc_attr( $tt->ID ); ?>"><p><strong>Cargas</strong></p><?php echo EpointPersonalTrainerPublic::get_loads_form( $tt->ID, $ex_id ); ?></div>
								</div>
								<div class="historial collapse" id="historial-<?php echo esc_attr( $tt->ID ); ?>-<?php echo $ex_id; ?>">
									<div class="historial-row head">
										<div class="remove"></div>
										<div class="date">Fecha</div>
										<div class="series">Series</div>
										<div class="repetitions">Repeticiones</div>
										<div class="loads">Cargas</div>
									</div>
								<?php $k = 0; ?>
								<?php foreach( $ex['historial'] as $h ) : ?>
									<div class="historial-row historial-row-data <?php if( $k ) : ?>historial-row-prev-data<?php endif; ?>">
										<div class="remove">
										<?php if( $k ) : ?>
											<button
												class="btn btn-danger btn-sm clear-exercise-historial-element"
												data-training="<?php echo esc_attr( $tt->ID ); ?>"
												data-exercise="<?php echo esc_attr( $ex_id ); ?>"
												data-saved="<?php echo esc_attr( $h->saved ); ?>"
											>
												<span class="glyphicon glyphicon-remove"></span>
											</button>
										<?php endif; ?>
										</div>
										<div class="date"><?php echo esc_html( date( 'd/m/Y', strtotime( $h->saved ) ) ); ?> </div>
										<div class="series"><?php echo esc_html( $h->series ); ?></div>
										<div class="repetitions"><?php echo esc_html( $h->repetitions ); ?></div>
										<div class="loads"><?php echo esc_html( $h->loads ); ?></div>
									</div>
									<?php $k++; ?>
								<?php endforeach; ?>
<?php if( false ) : // enable clear full exercise historial ?>
									<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?><p class="text-center"><a class="btn btn-primary clear-exercise-historial" data-exercise="<?php echo esc_attr( $ex_id ); ?>" data-training="<?php echo esc_attr( $tt->ID ); ?>">Borrar historial</a></p><?php endif; ?>
<?php endif; ?>
								</div>
							</div>
							<div class="more">
								<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#exercise-<?php echo esc_attr( $tt->ID ); ?>-<?php echo $ex_id; ?>" aria-expanded="false" aria-controls="exercise-<?php echo $ex_id; ?>">Detalles</button>
								<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#historial-<?php echo esc_attr( $tt->ID ); ?>-<?php echo $ex_id; ?>" aria-expanded="false" aria-controls="historial-<?php echo $ex_id; ?>">Historial</button>
							</div>
						</div>
						<div class="details collapse" id="exercise-<?php echo esc_attr( $tt->ID ); ?>-<?php echo $ex_id; ?>">
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
		
	</div></div>

</div>
<?php endif; // EliteTrainerSiteTheme::is_site_trainer() || $is_training_active  ?>
