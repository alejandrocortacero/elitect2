<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="front-photo">
	<img src="<?php echo wp_get_attachment_image_url( get_user_meta( $member->ID, 'front_photo', true ), EliteTrainerSiteTheme::EVOLUTION_IMAGE_SIZE ); ?>" alt="Foto de frente" />
</div>
<div class="side-photo">
	<img src="<?php echo wp_get_attachment_image_url( get_user_meta( $member->ID, 'profile_photo', true ), EliteTrainerSiteTheme::EVOLUTION_IMAGE_SIZE ); ?>" alt="Foto de perfil" />
</div>
<div class="text">
	<div class="inf">
		<?php if( !isset( $not_show_edit_button ) || !$not_show_edit_button ) : ?>
			<p class="text-right"><button class="btn btn-primary toggle-edit-personal-info">Editar</button></p>
		<?php else : ?>
			<p class="text-right"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_personal_questionnaire_url(); ?>">Editar</a></p>
		<?php endif; ?>
	</div>
	<div class="sup">
		<p><strong>Nombre:</strong> <?php echo esc_html( $member->first_name ); ?></p>
		<p><strong>Apellidos:</strong> <?php echo esc_html( $member->last_name ); ?></p>
		<p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr( $member->user_email ); ?>" rel="nofollow" target="_blank"><?php echo esc_html( $member->user_email ); ?></a></p>
		<p><strong>Nombre de usuario:</strong> <?php echo esc_html( $member->user_login ); ?></p>
		<?php $phone = get_user_meta( $member->ID, 'phone', true ); ?>
		<p><strong>Teléfono:</strong> <a href="tel:<?php echo preg_replace( '/[^0-9+]/', '', $phone ); ?>" rel="nofollow" target="_blank"><?php echo esc_html( $phone ); ?></a></p>
		<p><strong>Fecha de nacimiento:</strong> <?php echo esc_html( get_user_meta( $member->ID, 'elite_birthday', true ) ); ?></p>
		<p><strong>Sexo:</strong> <?php echo esc_html( get_user_meta( $member->ID, 'elite_sex', true ) == 'v' ? 'Varón' : 'Mujer' ); ?></p>
	</div>
</div>
