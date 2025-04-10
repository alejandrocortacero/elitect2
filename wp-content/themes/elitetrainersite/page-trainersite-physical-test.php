<?php defined( 'ABSPATH' ) or die('Wrong Access!');
$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = get_user_by( 'ID', $member_id );

$trainer_id = get_current_user_id();

$types = array( 'strength', 'speed', 'distance' );
$types_titles = array(
	'strength' => 'Ejercicios de fuerza',
	'speed' => 'Ejercicios de velocidad',
	'distance' => 'Ejercicios de distancia',
);
$types_labels = array(
	'strength' => 'Fuerza',
	'speed' => 'Velocidad',
	'distance' => 'Distancia',
);
$types_content = array(
	'strength' => array( 'key' => 'strengthmeasuresheadertext', 'content' => '<p>En esta hoja apuntaremos de forma semanal pesos y medidas corporales.</p><p>De forma personalizada nos podremos en contacto contigo y juntos plantearemos la perdida o aumento de peso corporal, como también el tiempo para lograr estos objetivos de semana en semana.</p>' ),
	'speed' => array( 'key' => 'speedmeasuresheadertext', 'content' => '<p>En esta hoja apuntaremos de forma semanal pesos y medidas corporales.</p><p>De forma personalizada nos podremos en contacto contigo y juntos plantearemos la perdida o aumento de peso corporal, como también el tiempo para lograr estos objetivos de semana en semana.</p>' ),
	'distance' => array( 'key' => 'distancemeasuresheadertext', 'content' => '<p>En esta hoja apuntaremos de forma semanal pesos y medidas corporales.</p><p>De forma personalizada nos podremos en contacto contigo y juntos plantearemos la perdida o aumento de peso corporal, como también el tiempo para lograr estos objetivos de semana en semana.</p>' ),
);

$magnitudes_arr = array();
$dates_arr = array();

foreach( $types as $type )
{
	$magnitudes = $trainer_id ? EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( $type, $trainer_id ) : null;

	if( !empty( $magnitudes ) )
	{
		$magnitudes_arr[$type] = $magnitudes;
		$measures = EpointPersonalTrainerMapper::get_user_evolution_values_by_type( $member_id, $type );
		$observations = EpointPersonalTrainerMapper::get_user_evolution_observations_by_type( $member_id, $type );

		$dates = array();
		foreach( $measures as $measure ) 
		{
			if( !array_key_exists( $measure->when, $dates ) )
				$dates[$measure->when] = array();

			if( !array_key_exists( (int)$measure->magnitude, $dates[$measure->when] ) )
				$dates[$measure->when][(int)$measure->magnitude] = array( 'value' => null, 'observations' => null );

			$dates[$measure->when][(int)$measure->magnitude]['value'] = $measure->value;
			$obser = null;

			foreach( $observations as $o )
			{
				if( $o->when == $measure->when && $o->magnitude == $measure->magnitude )
				{
					$obser = $o;
					break;
				}
			}
			$dates[$measure->when][(int)$measure->magnitude]['observations'] = $obser ? $obser->observations : null;
		}

		$dates_arr[$type] = $dates;
	}
}


add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-member-physical-test'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
<h1><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $member_id ); ?>">Volver al perfil</a> Pruebas físicas de <?php echo esc_html( $member->display_name ); ?></h1>
			<?php if( empty( $magnitudes_arr ) ) : ?>
				<p>No hay mediciones disponibles.</p>
			<?php elseif( count( $magnitudes_arr ) == 1 ) : ?>
				<?php foreach( $types as $type ) : ?>
					<?php if( !empty( $magnitudes_arr[$type] ) ) : ?>
						<?php $dates = $dates_arr[$type]; ?>	
						<?php $magnitudes = $magnitudes_arr[$type]; ?>
						<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member', 'physical-test.php' ) ) ); ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php else : ?>
				<ul class="nav nav-tabs" role="tablist" id="physical-test-tabs">
				<?php $i = 0; ?>
				<?php foreach( $types as $type ) : ?>
					<?php $is_active = ( isset( $_COOKIE[EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE] ) && $_COOKIE[EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE] == '#physical-test-' . $type ) || ( !isset( $_COOKIE[EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE] ) && !$i ); ?>
					<li role="presentation" <?php if( $is_active ) : ?>class="active"<?php endif; ?>><a href="#physical-test-<?php echo $type; ?>" aria-controls="physical-test-<?php echo $type; ?>" role="tab" data-toggle="tab"><?php echo $types_labels[$type]; ?></a></li>
					<?php $i++; ?>
				<?php endforeach; ?>
				</ul>
				<?php $i = 0; ?>
				<div class="tab-content">
				<?php foreach( $types as $type ) : ?>
					<?php $is_active = ( isset( $_COOKIE[EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE] ) && $_COOKIE[EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE] == '#physical-test-' . $type ) || ( !isset( $_COOKIE[EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE] ) && !$i ); ?>
					<div role="tabpanel" class="tab-pane <?php if( $is_active ) : ?>active<?php endif; ?>" id="physical-test-<?php echo $type; ?>">
						<?php $dates = $dates_arr[$type]; ?>	
						<?php $magnitudes = $magnitudes_arr[$type]; ?>
						<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member', 'physical-test.php' ) ) ); ?>
					</div>
					<?php $i++; ?>
				<?php endforeach; ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){

	jQuery('#physical-test-tabs li a').click(function(evt){
evt.stopPropagation();
evt.preventDefault();
		var l = jQuery(evt.currentTarget);
console.log(l.attr('href'));
		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000));
		document.cookie = '<?php echo EliteTrainerSiteTheme::PHYSICAL_TEST_TAB_COOKIE; ?>' + "=" + l.attr('href') + "; expires=" + d.toUTCString() + "; path=/";

		window.location.reload(true);
	});
});
</script>

<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
