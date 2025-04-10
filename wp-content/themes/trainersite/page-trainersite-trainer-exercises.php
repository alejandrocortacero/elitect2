<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('trainer');

wp_enqueue_script(
	'trainersite-trainer-exercises-script',
	get_template_directory_uri() . '/js/trainer-exercises.js',
	array( 'jquery' ),
	TrainerSiteTheme::get_version(),
	true
);
wp_localize_script(
	'trainersite-trainer-exercises-script',
	'TrainerSiteExercises',
	array(
		'url' => admin_url( 'admin-ajax.php' ),
		'getNewExerciseFormAction' => TrainerSiteTheme::NEW_EXERCISE_FORM_ACTION,
		'loadExerciseAction' => TrainerSiteTheme::LOAD_EXERCISE_ACTION,
		'editExerciseAction' => TrainerSiteTheme::EDIT_EXERCISE_ACTION,
		'insertExerciseAction' => TrainerSiteTheme::INSERT_EXERCISE_ACTION,
		'cloneExerciseAction' => TrainerSiteTheme::CLONE_EXERCISE_ACTION,
		'deleteExerciseAction' => TrainerSiteTheme::DELETE_EXERCISE_ACTION
	)
);
?>
<?php if( is_user_logged_in() && is_user_member_of_blog() && current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
<?php $user = wp_get_current_user(); ?>
<div class="container-fluid container-trainer container-trainer-exercises">
	<div class="row section-header-row">
		<div class="col-xs-12">
			<?php get_template_part( 'templates/settings', 'menu2' ); ?>
			<h1 class="main-title"><?php echo esc_html( __( 'My exercises', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
		</div>
	</div>
	<div class="container content">
		<div class="row">
			<div class="col-xs-12 page-content trainer-settings-content">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#my-exercises" aria-controls="my-exercises" role="tab" data-toggle="tab">Mis ejercicios</a></li>
					<li role="presentation"><a href="#preset-exercises" aria-controls="preset-exercises" role="tab" data-toggle="tab">Predefinidos</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="my-exercises">
						<div class="exercises">
							<div class="create-new">
								<div class="images">
									<button type="button" class="add-exercise"><img src="<?php echo get_template_directory_uri(); ?>/img/buttons/plus.png" /></button>
								</div>
								<div class="title">
									<p><?php echo esc_html( __( 'Add exercise', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></p>
								</div>
							</div>
						<?php $exercises = EpointPersonalTrainerMapper::get_trainer_exercises( $user->ID ); ?>
						<?php if( !empty( $exercises ) ) : ?>
							<?php foreach( $exercises as $exercise ) : ?>
								<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-icon.php' ) ) ); ?>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="preset-exercises">
						<div class="exercises">
						<?php $exercises = EpointPersonalTrainerMapper::get_preset_exercises(); ?>
						<?php if( !empty( $exercises ) ) : ?>
							<?php foreach( $exercises as $exercise ) : ?>
								<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'exercise-icon.php' ) ) ); ?>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="view-exercise" tabindex="-1" role="dialog" aria-labelledby="view-exercise-label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="view-exercise-label">Ejercicio</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-exercise" tabindex="-1" role="dialog" aria-labelledby="edit-exercise-label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="edit-exercise-label"><?php echo esc_html( __( 'New Exercise', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h4>
      </div>
      <div class="modal-body">
		<?php $exercise_form = TrainerSiteTheme::get_edit_exercise_form(); ?>
		<?php echo $exercise_form; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php get_footer('trainer'); ?>
