<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !EpointPersonalTrainer::is_site_client() && !EpointPersonalTrainer::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$member = wp_get_current_user();

$last = get_user_meta( $member->ID, 'personal_trainer_food_questionnaire_date', true );

update_user_meta( $member->ID, 'personal_trainer_food_questionnaire_show_info', 'yes' );
$show_info = get_user_meta( $member->ID, 'personal_trainer_food_questionnaire_show_info', true ) !== 'no';
update_user_meta( $member->ID, 'personal_trainer_food_questionnaire_show_info', 'no' );


add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-food-questionnaire'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<h1>Cuestionario sobre gustos y hábitos dietéticos <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Volver al perfil</a></h1>
<?php if( false ) : ?>
						<p>Valora de 1 al 10 según tus gustos y prioridades en tus hábitos diarios.</p>
						<p>Los alimentos que te gusten y no tengas costumbre de tomar, márcalos con una "N" y marca con una "S" los que más tomas. A parte de la puntuación de cada alimento.</p>
<?php endif; ?>
<?php if( false ) : ?>
						<p>Indica con una S los alimentos que tengas costumbre de tomar y con una N los que no. Los valores del 1 al 10 indican tu nivel de gusto hacia el alimento.</p>
<?php endif; ?>
						<?php if( $show_info ) : ?>
						<div class="alert alert-info">
							<p>El siguiente formulario nos informará de que alimentos tienes costumbre de tomar (S) o en caso contrario (N) y el nivel de gusto por el que se valorara del 1 (minimo) al 10 (maximo).</p>
							<p>Si en los grupos de alimentos marcados, no encuentras algunos que sueles tomar, escríbelo en la columna de No en lista y puntúalo de la forma anteriormente indicada.</p>
							<p>Un análisis de sangre previo al seguimiento diétetico sería de gran ayuda para valorar carencias y necesidades de cada persona. En su defecto, se comunicará de forma verbal cualquier problema relacionado con la salud.</p>
						</div>
						<?php endif; ?>
						<h2>Diferentes significados según puntuación</h2>
						<div class="table-responsive">
							<table class="table">
								<thead><tr>
									<th>Puntuación</th>
									<th>Significado</th>
								</tr></thead>
								<tbody>
									<tr><td>1</td><td>Solo el olor me pone malo</td></tr>
									<tr><td>2</td><td>No me gusta nada</td></tr>
									<tr><td>3</td><td>Lo evito siempre que puedo</td></tr>
									<tr><td>4</td><td>Alguna vez puntual pero si puedo elegir, cambio</td></tr>
									<tr><td>5</td><td>Si me lo ponen, me lo como, pero yo no me lo hago</td></tr>
									<tr><td>6</td><td>Lo como sin problemas</td></tr>
									<tr><td>7</td><td>Me gusta bastante</td></tr>
									<tr><td>8</td><td>Me gusta mucho</td></tr>
									<tr><td>9</td><td>Me gusta muchísimo</td></tr>
									<tr><td>10</td><td>Lo comería todos o casi todos los dias</td></tr>
								</tbody>
							</table>
						</div>
						<?php if( !empty( $last ) ) : ?>
							<div class="alert alert-info"><p>Ultima actualización: <?php echo date( 'd/m/y', strtotime( $last ) ); ?></p></div>
						<?php endif; ?>
						<div class="food-questionnaire-layer">
							<?php echo EpointPersonalTrainerPublic::get_food_questionnaire_form( $member->ID ); ?>
						</div>
						<hr />
						<h2>Alimentos que no están en la lista</h2>
						<p>En este espacio puedes añadir alimentos que crees que deben ser valorados pero no están en la lista.</p>
                        <p>Recuerda guardar el formulario de gustos dietéticos previamente.</p>
						<div class="add-user-food-layer">
							<?php echo EpointPersonalTrainerPublic::get_add_user_food_form( $member->ID ); ?>
						</div>
					<?php endif; //class_exists ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>
<script>
    document.querySelector('.add-user-food-form').addEventListener('submit', function (event) {
        const questionnaireForm = document.querySelector('.food-questionnaire-form');
        const serializedData = new FormData(questionnaireForm);


        serializedData.forEach((value, key) => {
            if (!this.querySelector(`[name="${key}"]`)) { // Avoid duplicate fields
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = key;
                hiddenInput.value = value;
                this.appendChild(hiddenInput);
            }
        });
    });
</script>
<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>

