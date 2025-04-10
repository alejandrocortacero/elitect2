<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

$personal_info = EpointPersonalTrainer::get_user_personal_info( $member->ID );
$attr = $personal_info->get_attributes();
$member_objectives = $personal_info::get_available_objectives();
$tension_labels = array( 'low' => 'Baja', 'medium' => 'Media', 'high' => 'Alta' );
?>
<?php if( $personal_info->has_filled_personal_questionnaire() ) : ?>
	<p><strong>Objetivos</strong></p>
	<ul>
	<?php foreach( $attr['objectives'] as $o ) : ?>
		<li><?php echo esc_html( isset( $member_objectives[$o] ) ? $member_objectives[$o] : $o ); ?></li>
	<?php endforeach; ?>
	</ul>
	<p><strong>Salud</strong></p>
	<p>Lesionado: <?php echo esc_html( $attr['injured'] == 'yes' ? 'Sí' : 'No' ); ?></p>
	<p>Enfermedad: <?php echo esc_html( $attr['illness'] ); ?></p>
	<p>Medicación: <?php echo esc_html( $attr['medication'] ); ?></p>
	<p>Tensión: <?php echo esc_html( isset( $tension_labels[$attr['tension']] ) ? $tension_labels[$attr['tension']] : $attr['tension'] ); ?></li>
	<p><strong>Deporte</strong></p>
	<p>Práctica habitual: <?php echo esc_html( $attr['do_sport'] == 'yes' ? 'Sí' : 'No' ); ?></p>
	<p>Deporte: <?php echo esc_html( $attr['sport'] ); ?></p>
	<p>Tiempo practicándolo: <?php echo esc_html( $attr['when_sport'] ); ?></p>
	<p>Frecuencia: <?php echo esc_html( $attr['frequency_sport'] ); ?></p>
	<p><strong>Disponibilidad</strong></p>
	<p>Días a la semana: <?php echo esc_html( $attr['frequency_training'] ); ?></p>
	<p>Horas al día: <?php echo esc_html( $attr['available_hours'] ); ?></p>
	<p><strong>Ocupación</strong></p>
	<p><?php echo esc_html( $attr['occupation'] == 'work' ? 'Trabaja' : 'Estudia' ); ?> (<?php echo esc_html( $attr['occupation_type'] == 'active' ? 'Activo' : 'Sedentario' ); ?>)</p>
	<p><strong>Rutina</strong></p>
	<p>Horas sueño: <?php echo esc_html( $attr['sleep_hours'] ); ?></p>
	<p>Come saludablemente: <?php echo esc_html( $attr['feed'] == 'yes' ? 'Sí' : 'No' ); ?></p>
	<p>Comidas al día: <?php echo esc_html( $attr['feed_frequency'] ); ?></p>

<?php else : ?>
	<p>El usuario no ha rellenado el formulario aun.</p>
<?php endif; ?>
