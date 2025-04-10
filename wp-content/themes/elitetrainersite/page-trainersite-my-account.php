<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-trainer-edit-member'; return $classes; }, 10, 2 );

get_header('noopen');

?>
<?php if( !is_user_logged_in() || !is_user_member_of_blog() ) : ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 page-content">
			<br/>
			<h2 class="cool-heading text-center"><?php echo esc_html( __( 'Ya soy socio', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			<br/>
			<?php wp_login_form(); ?>
			<p><a href="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" rel="nofollow">Si olvidaste tu contraseña, introduce tu email.</a></p>
		</div>
		<div class="col-xs-12 col-sm-6 page-content">
			<br/>
			<h2 class="cool-heading text-center"><?php echo esc_html( __( 'Quiero inscribirme', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h2>
			<br/>
			<?php echo EpointPersonalTrainerPublic::get_register_user_form(); ?>
		</div>
	</div>
</div>
<?php else : ?>
<?php $user = wp_get_current_user(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 page-content">
			<br />
			<h2>Hola <?php echo $user->display_name; ?></h2>
			<?php if( is_super_admin() || EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
					<p class="text-right"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_info_url(); ?>">Editar mi información</a></p>
					<div class="trainer-info-card row">
					<?php
						EpointPersonalTrainer::load_trainer_info_management();
						$trainer_info = new EpointPersonalTrainerTrainerInfo( get_current_user_id() );
						$trainer_info_attr = $trainer_info->get_attributes();

					?>
						<div class="col-xs-12 col-sm-4">
						<?php if( isset( $trainer_info_attr['public_photo'] ) ) : ?>
							<?php $photo_id = $trainer_info_attr['public_photo']; ?>
							<img class="img-responsive" src="<?php echo wp_get_attachment_image_url( $photo_id, 'full' ); ?>" alt="Foto" />
						<?php endif; ?>
						</div>
						<div class="col-xs-12 col-sm-8">
							<p class="h3"><?php echo esc_html( $user->display_name ); ?></p>
							<p class="h4"><?php echo get_user_meta( $user->ID, 'first_name', true ); ?> <?php echo get_user_meta( $user->ID, 'last_name', true ); ?></p>
							<hr />
						<?php if( !empty( $trainer_info_attr['company_name'] ) ) : ?>

							<p><strong>Empresa:</strong> <?php echo esc_html( $trainer_info_attr['company_name'] ); ?>
							<p><strong>Provincia:</strong> <?php echo esc_html( !empty( $trainer_info_attr['province'] ) ? $trainer_info_attr['province'] : '' ); ?>
							<p><strong>Desde:</strong> <?php echo esc_html( !empty( $trainer_info_attr['company_year'] ) ? $trainer_info_attr['company_year'] : '' ); ?>
							<p><strong>Trabajadores:</strong> <?php echo esc_html( !empty( $trainer_info_attr['company_workers'] ) ? $trainer_info_attr['company_workers'] : '' ); ?>
							<p><strong>Superficie:</strong> <?php echo esc_html( !empty( $trainer_info_attr['company_m2'] ) ? $trainer_info_attr['company_m2'] : '' ); ?>
							<p><strong>Actividades:</strong> <?php echo esc_html( !empty( $trainer_info_attr['company_activities'] ) ? $trainer_info_attr['company_activities'] : '' ); ?>
							<p><strong>Equpamiento:</strong> <?php echo esc_html( !empty( $trainer_info_attr['company_equipment'] ) ? $trainer_info_attr['company_equipment'] : '' ); ?>

						<?php else : ?>
							<p><strong>Edad:</strong> <?php echo !empty( $trainer_info_attr['age'] ) ? $trainer_info_attr['age'] : ''; ?></p>
							<p><strong>Sexo:</strong> <?php echo !empty( $trainer_info_attr['sex'] ) ? ( $trainer_info_attr['sex'] === 'v' ? 'Varón' : 'Mujer' ) : ''; ?></p>
							<p><strong>Ciudad de residencia:</strong> <?php echo !empty( $trainer_info_attr['city'] ) ? $trainer_info_attr['city'] : ''; ?></p>
							<p><strong>Provincia:</strong> <?php echo esc_html( !empty( $trainer_info_attr['province'] ) ? $trainer_info_attr['province'] : '' ); ?>

							<p><strong>Experiencia:</strong> <?php echo esc_html( !empty( $trainer_info_attr['experience_years'] ) ? $trainer_info_attr['experience_years'] . ' años' : '' ); ?>
							<p><strong>Estudios:</strong> <?php echo esc_html( !empty( $trainer_info_attr['studies'] ) ? $trainer_info_attr['studies'] : '' ); ?>
						<?php endif; ?>
							<?php if( !empty( $trainer_info_attr['sports'] ) && is_array( $trainer_info_attr['sports'] ) ) :?>
								<?php $t_sports = $trainer_info_attr['sports']; ?>
						
								<?php $t_sports = array_map( function( $a ){ $sports = array(
							'athletics' => 'Atletismo',
							'swimming' => 'Natación',
							'football' => 'Fútbol',
							'gymnastics' => 'Gimnasia',
							'tennis' => 'Tenis',
							'padel' => 'Padel',
							'contact' => 'De contacto',
							'golf' => 'Golf',
							'climb' => 'Escalada',
							'trekking' => 'Senderismo'
						); return array_key_exists( $a, $sports ) ? $sports[$a] : $a; }, $t_sports ); ?>  
								<p><strong>Deportes:</strong> <?php echo implode( ', ', $t_sports ); ?></p>
							<?php endif; ?>

						</div>
					</div>
				<?php endif; ?>
				<hr />
				<?php if( false ) : ?>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3 text-center">
						<h3>Socios</h3>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_members_list_url(); ?>">Lista de socios</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url(); ?>">Añadir nuevo socio</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_delete_members_list_url(); ?>">Dar de baja</a></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 text-center">
						<h3>Dietas</h3>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_diets_list_url(); ?>">Dietas</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_food_list_url(); ?>">Alimentos</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_diet_objectives_list_url(); ?>">Restricciones y objetivos</a></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 text-center">
						<h3>Entrenamientos</h3>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_training_list_url(); ?>">Entrenamientos</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_exercises_list_url(); ?>">Ejercicios</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_objectives_list_url(); ?>">Entornos y objetivos</a></p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 text-center">
						<h3>Evolución</h3>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_body_measures_url(); ?>">Medidas corporales</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_strength_exercises_url(); ?>">Fuerza</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_speed_exercises_url(); ?>">Velocidad</a></p>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_distance_exercises_url(); ?>">Distancia</a></p>
					</div>
				</div>
				<?php endif; ?>


				<?php if( !empty( $trainer_info_attr['company_name'] ) ) : ?>
					<p><strong>Parking privado:</strong> <?php echo !empty( $trainer_info_attr['company_parking'] ) ? ( $trainer_info_attr['company_parking'] === 'yes' ? 'Sí' : 'No' ) : ''; ?></p>
					<p><strong>Aire acondicionado:</strong> <?php echo !empty( $trainer_info_attr['air_conditioning'] ) ? ( $trainer_info_attr['air_conditioning'] === 'yes' ? 'Sí' : 'No' ) : ''; ?></p>
					<?php if( !empty( $trainer_info_attr['company_prices'] ) ) : ?>
						<?php echo wpautop( $trainer_info_attr['company_prices'] ); ?>
					<?php endif; ?>
					<?php if( !empty( $trainer_info_attr['company_comments'] ) ) : ?>
						<?php echo wpautop( $trainer_info_attr['company_comments'] ); ?>
					<?php endif; ?>
				<?php else : ?>
					<p><strong>Teléfono:</strong> <?php echo !empty( $trainer_info_attr['phone'] ) ? $trainer_info_attr['phone'] : ''; ?></p>
					<p><strong>Precio de la hora presencial:</strong> <?php echo !empty( $trainer_info_attr['presential_price'] ) ? $trainer_info_attr['presential_price'] : ''; ?> &euro;</p>
					<p><strong>Precio de la hora online:</strong> <?php echo !empty( $trainer_info_attr['online_price'] ) ? $trainer_info_attr['online_price'] : ''; ?> &euro;</p>
					<p><strong>Experiencia laboral:</strong></p>
					<?php if( !empty( $trainer_info_attr['experience'] ) ) : ?>
						<?php echo wpautop( $trainer_info_attr['experience'] ); ?>
					<?php endif; ?>
					<p><strong>Estudios:</strong></p>
					<?php if( !empty( $trainer_info_attr['studies'] ) ) : ?>
						<?php echo wpautop( $trainer_info_attr['studies'] ); ?>
					<?php endif; ?>
					<p><strong>Comentarios:</strong></p>
					<?php if( !empty( $trainer_info_attr['comments'] ) ) : ?>
						<?php echo wpautop( $trainer_info_attr['comments'] ); ?>
					<?php endif; ?>
				<?php endif; ?>

				<hr />
				<div class="bars">
					<p>Dietética</p>
					<div class="bar"><div class="inner" style="width:<?php echo (int)$trainer_info_attr['dietetics'] * 10; ?>%;"></div></div>
					<p>Hipertrofia</p>
					<div class="bar"><div class="inner" style="width:<?php echo (int)$trainer_info_attr['hypertrophy'] * 10; ?>%;"></div></div>
					<p>Adelgazamiento</p>
					<div class="bar"><div class="inner" style="width:<?php echo (int)$trainer_info_attr['slimming'] * 10; ?>%;"></div></div>
					<p>Oposiciones</p>
					<div class="bar"><div class="inner" style="width:<?php echo (int)$trainer_info_attr['examinations'] * 10; ?>%;"></div></div>
					<p>Rehabilitación</p>
					<div class="bar"><div class="inner" style="width:<?php echo (int)$trainer_info_attr['rehab'] * 10; ?>%;"></div></div>
				</div>
			
			<?php else : ?>
				<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member', 'my-profile.php' ) ) ); ?>
				<?php if( false ) : ?>
				<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_my_training_url(); ?>">Mis entrenamientos</a></p>
				<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_personal_questionnaire_url(); ?>">Mi cuestionario personal</a></p>
				<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_member_food_questionnaire_url(); ?>">Hábitos dietéticos</a></p>
				<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_member_habits_url(); ?>">Hábitos rutinarios</a></p>
				<?php endif; ?>
			<?php endif; ?>

			<hr />
			<p><a href="<?php echo wp_logout_url( get_bloginfo( 'url' ) ); ?>">Logout</a></p>

		</div>
	</div>
</div>
<?php endif; ?>

<?php if( class_exists( 'EpointPersonalTrainer', false ) &&
			EpointPersonalTrainer::is_site_client() &&
			get_user_meta( get_current_user_id(), 'personal_trainer_first_info_filled', true ) !== 'yes'
		) : ?>
	
	<?php // Quiźa convendría asegurarse de que todo esta relleno antes de realizar la actualización de la siguiente línea ?>
	<?php update_user_meta( get_current_user_id(), 'personal_trainer_first_info_filled', 'yes' ); ?>
	<?php
		$user = wp_get_current_user();
		$site_trainer = EliteTrainerSiteTheme::get_site_trainer();

		if( $site_trainer )
			wp_mail(
				$site_trainer->user_email,
				'Un usuario ha completado su perfil.',
				'El usuario ' . $user->display_name . ' (' . $user->user_email . ') ha completado su perfil.'
			);
	?>
	<?php get_template_part( 'templates/first-modals/last', 'suggestions' ); ?>
<?php endif; ?>
<?php get_footer('noclose'); ?>
