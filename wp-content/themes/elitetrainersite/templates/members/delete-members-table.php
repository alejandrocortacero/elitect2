<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="table-responsive"><table class="table table-striped">
	<thead><tr>
		<th></th>
		<th>Nombre</th>
		<th>Email</th>
		<th>Teléfono</th>
		<th>Edad</th>
		<th>Sexo</th>
		<th></th>
	</tr></thead>
	<tbody>
	<?php foreach( $users as $user ) : ?>
		<tr>
<td><img src="<?php echo wp_get_attachment_image_url( get_user_meta( $user->ID, 'front_photo', true ), 'thumbnail' ); ?>" style="width:50px;" /></td>
<td><a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $user->ID ); ?>"><?php echo $user->display_name; ?></a></td>
<td><a href="mailto:<?php echo esc_attr( $user->user_email ); ?>"><?php echo esc_html( $user->user_email ); ?></a></td>
<td><a href="tel:<?php echo esc_attr( get_user_meta( $user->ID, 'phone', true ) ); ?>"><?php echo esc_html( get_user_meta( $user->ID, 'phone', true ) ); ?></a></td>
<td><?php echo esc_html(  get_user_meta( $user->ID, 'elite_birthday', true )  ); ?></td>
<td><?php echo esc_html(  get_user_meta( $user->ID, 'elite_sex', true ) == 'v' ? 'Varón' : 'Mujer'  ); ?></td>
<td>
	<button class="btn btn-danger delete-member" data-toggle="modal" data-target="#delete-member-modal" data-member="<?php echo esc_attr( $user->ID ); ?>">Dar de baja</button>
	<?php if( get_user_meta( $user->ID, 'is_deactivated', true ) !== 'yes' ) : ?>
	<button class="btn btn-danger deactivate-member" data-toggle="modal" data-target="#deactivate-member-modal" data-member="<?php echo esc_attr( $user->ID ); ?>">Desactivar temporalmente</button>
	<?php else : ?>
	<button class="btn btn-primary reactivate-member" data-toggle="modal" data-target="#reactivate-member-modal" data-member="<?php echo esc_attr( $user->ID ); ?>">Reactivar</button>
	<?php endif; ?>
</td>

		</tr>
	<?php endforeach; ?>
	</tbody>
</table></div>

