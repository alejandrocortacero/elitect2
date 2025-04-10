<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php $user_id = get_current_user_id(); ?>
<?php if( !empty( $exercise ) && ( !$exercise->trainer || $exercise->trainer == $user_id ) ) : ?>
	<div class="row exercise-card" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="text-center"><?php echo esc_html( $exercise->name ); ?> <?php if( $exercise->active ) : ?>(Activo)<?php else : ?>(Inactivo)<?php endif; ?></h3>
				</div>
				<div class="col-xs-12 col-sm-6">
					<img src="<?php echo TrainerSiteTheme::get_exercise_image( $exercise->image_start ); ?>" class="img-responsive center-block" />
					<h4 class="text-center">Foto inicial</h4>
				</div>
				<div class="col-xs-12 col-sm-6">
					<img src="<?php echo TrainerSiteTheme::get_exercise_image( $exercise->image_end ); ?>" class="img-responsive center-block" />
					<h4 class="text-center">Foto final</h4>
				</div>
			</div>
			<?php if( !empty( $exercise->video ) ) : ?>
			<div class="row">
				<div class="col-xs-12 video-col">
					<h4 class="text-center">Vídeo</h4>
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( $exercise->video ); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-xs-12 description-col">
					<h4>Descripción</h4>
					<?php echo nl2br( wp_kses_post( $exercise->description ) ); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="buttons text-center">
						<?php if( $exercise->trainer ) : ?>
						<a class="btn btn-primary edit-exercise" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>">Editar</a>
						<?php endif; ?>
						<a class="btn btn-primary clone-exercise" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>">Clonar</a>
						<?php if( $exercise->trainer ) : ?>
						<a class="btn btn-primary delete-exercise" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>">Borrar</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<p>Ejercicio no disponible</p>
<?php endif; ?>
