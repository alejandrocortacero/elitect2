<?php defined( 'ABSPATH' ) or die('Wrong Access!');

$member = wp_get_current_user();
$member_id = $member->ID;

$not_show_edit_button = true;
?>
<div class="row">
	<div class="col-xs-12">
		<div class="main-info read shadow-box">
			<div class="info">
				<?php include( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'member-edit-personal-info.php' ) ) ) ); ?>
			</div>
<?php if( false ) : ?>
			<div class="edit-info">
				<p class="text-right"><button class="btn btn-primary toggle-edit-personal-info">Volver</button></p>
				<?php echo EpointPersonalTrainerPublic::get_edit_member_full_form( $member_id ); ?>
			</div>
<?php endif; ?>
		</div>
<?php if( false ) : ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.main-info .toggle-edit-personal-info').click(function(evt){jQuery(this).closest('.main-info').toggleClass('read');});
			});
		</script>
<?php endif; ?>
		<div class="shadow-box">
			<h3>Dietas y hábitos</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_diets_url(); ?>" class="btn btn-primary" rel="nofollow">Dietas personalizadas <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_food_questionnaire_url(); ?>" class="btn btn-primary" rel="nofollow">Cuestionario dietético <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_habits_url(); ?>" class="btn btn-primary" rel="nofollow">Ver/Editar hábitos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
<?php if( false ) : ?>
		<div class="shadow-box">
			<h3>Alimentación</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_food_questionnaire_url(); ?>" class="btn btn-primary" rel="nofollow">Puntúa alimentos según tus gustos y hábitos de tomarlos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_habits_url(); ?>" class="btn btn-primary" rel="nofollow">Indica tus hábitos actuales / franjas horarias y alimentos habituales <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
<?php endif; ?>
		<div class="shadow-box">
			<h3>Entrenamientos</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_my_training_url(); ?>" class="btn btn-primary" rel="nofollow">Fechas, horarios y partes trabajadas <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
<?php if( false ) : ?>
		<div class="shadow-box">
			<h3>Progresos</h3>
			<p><a href="#" class="btn btn-primary" rel="nofollow">Actualizar mis progresos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="#" class="btn btn-primary" rel="nofollow">Ver tabla y gráficos de mis progreso <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="#" class="btn btn-primary" rel="nofollow">Ver y añadir fotos de evolución <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
<?php endif; ?>
		<div class="shadow-box">
			<h3>Evolución</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_corporal_measures_url(); ?>" class="btn btn-primary" rel="nofollow">Zona de peso y medidas corporales <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_physical_test_url(); ?>" class="btn btn-primary" rel="nofollow">Pruebas físicas <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_member_evolution_photos_url(); ?>" class="btn btn-primary" rel="nofollow">Fotos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="personal-questionnaire-info shadow-box">
			<h3>Cuestionario personal</h3>
			<?php include( realpath( implode( DIRECTORY_SEPARATOR, array( __DIR__, '..', 'member-edit-personal-questionnaire.php' ) ) ) ); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
	</div>
</div>
