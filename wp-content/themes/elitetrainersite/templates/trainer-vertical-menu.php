<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<?php if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) || current_user_can( EpointPersonalTrainer::SPORTSMAN_ROLE ) ) : ?>
<?php $user = wp_get_current_user(); ?>
<div class="trainer-vertical-menu">
	<div class="close-menu">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</div>
	<div class="trainer-vertical-menu-inner">
		<div class="user-info">
			<img src="<?php echo get_template_directory_uri(); ?>/img/user/blank.jpg" alt="user" />
			<p class="user-name"><?php echo esc_html( $user->display_name ); ?></p>
			<p class="user-mail"><?php echo esc_html( $user->user_email ); ?></p>
			<p class="close-session"><a href="<?php echo wp_logout_url( get_bloginfo( 'url' ) ); ?>" rel="nofollow">Cerras sesión</a></p>
		</div>
		<div class="menu">
			<?php if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
				<?php if( !empty( $_GET['member'] ) && is_numeric( $_GET['member'] ) ) : ?>
					<?php $member_id = sanitize_text_field( $_GET['member'] ); ?>
			<ul>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $member_id ); ?>">Perfil del cliente</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_user_diets_url( $member_id ); ?>">Dietas</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_my_training_url(  ); ?>">Entrenamientos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_physical_test_url( $member_id ); ?>">Evolución y resultados obtenidos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_user_food_questionnaire_url( $member_id ); ?>">Gustos dietéticos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_user_habits_url( $member_id ); ?>">Hábitos rutinarios</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_corporal_measures_url( $member_id ); ?>">Medidas corporales</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_physical_test_url( $member_id ); ?>">Pruebas físicas</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_evolution_photos_url( $member_id ); ?>">Fotos evolución</a></li>
				<?php if( false ) : ?><li><a href="#">Mis planes</a></li><?php endif; ?>
				<?php endif; ?>
			</ul>
			<?php elseif( current_user_can( EpointPersonalTrainer::SPORTSMAN_ROLE ) ) : ?>
			<ul>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Mi perfil</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_member_diets_url(); ?>">Mis dietas</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_my_training_url(); ?>">Mis entrenamientos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_member_corporal_measures_url(); ?>">Medidas corporales</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_member_physical_test_url(); ?>">Pruebas físicas</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_member_food_questionnaire_url(); ?>">Gustos dietéticos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_member_habits_url(); ?>">Hábitos rutinarios</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_member_evolution_photos_url(); ?>">Fotos evolución</a></li>
				<?php if( false ) : ?><li><a href="#">Mis planes</a></li><?php endif; ?>
			</ul>
			<?php endif; ?>
			<?php if( current_user_can( EpointPersonalTrainer::TRAINER_ROLE ) ) : ?>
			<hr />
			<ul>
				<li><a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=toggle_customization" class="toggle-customization"><?php echo get_blog_option( null, EliteTrainerSiteThemeCustomizer::IS_CUSTOMIZATION_ACTIVE_KEY ) == 'yes' ? 'Desactivar personalización' : 'Activar personalización'; ?></a></li>
			</ul>
			<hr />
			<ul>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_members_list_url(); ?>">Lista de socios</a></li>
				<?php if( true ) : ?><li><a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url(); ?>">Añadir nuevo socio</a></li><?php endif; ?>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_delete_members_list_url(); ?>">Dar de baja</a></li>
			</ul>
			<hr />
<?php if( false ) : ?>
			<ul>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>">Zona de creación</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_objectives_list_url(); ?>">Objetivos y entornos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_exercises_list_url(); ?>">Galería de ejercicios y categorías</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_training_list_url(); ?>">Galería de entrenamientos</a></li>
			</ul>
<?php endif; ?>
			<ul>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>">Creación de contenido</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>">Zona de creación de entrenamientos / ejercicios / entornos / objetivos</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>">Zona de creación de dietas / alimentos / objetivos / alergías e intolerancias</a></li>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>">Zona de creación evolutiva</a></li>
				<ul style="padding-left:20px;">
					<li><a href="<?php echo EliteTrainerSiteTheme::get_trainer_body_measures_url(); ?>">Pesos y medidas corporales</a></li>
					<li><a href="<?php echo EliteTrainerSiteTheme::get_trainer_strength_exercises_url(); ?>">Ejercicios de fuerza</a></li>
					<li><a href="<?php echo EliteTrainerSiteTheme::get_trainer_speed_exercises_url(); ?>">Ejercicios de velocidad</a></li>
					<li><a href="<?php echo EliteTrainerSiteTheme::get_trainer_distance_exercises_url(); ?>">Distancia (balón medicinal, jabalina, etc)</a></li>
				</ul>
				<ul style="padding-left:20px;">
					<li><a href="<?php echo EliteTrainerSiteTheme::get_member_corporal_measures_url(); ?>">Ver página de medidas corporales</a></li>
					<li><a href="<?php echo EliteTrainerSiteTheme::get_member_physical_test_url(); ?>">Ver página de pruebas físicas</a></li>
					<?php if( false ) : ?><li><a href="<?php echo EliteTrainerSiteTheme::get_member_evolution_photos_url(); ?>">Ver página de fotos de evolución</a></li><?php endif; ?>
				</ul>
			</ul>
			<ul>
				<li><a href="<?php echo EliteTrainerSiteTheme::get_alerts_settings_page_url(); ?>">Configuración de alertas</a></li>
			</ul>
			<?php endif; ?>
			<hr />
			<ul>
				<li><a href="<?php echo wp_logout_url( get_bloginfo( 'url' ) ); ?>">Cerrar sesión</a></li>
			</ul>
		</div>	
	</div>
</div>
<?php endif; ?>

