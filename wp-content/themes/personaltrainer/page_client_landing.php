<?php /* Template Name: Client Landing */
defined('ABSPATH') or die( 'Wrong Access' );

wp_enqueue_script( 'jquery-ui-slider' );
wp_enqueue_style( 'jquery-ui-slider-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), '1.0' );

wp_enqueue_script( 'jquery-ui-touch-punch', '//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', array( 'jquery-ui-slider' ), '1.0' );

?><?php get_header('noopen'); ?>
<div class="container-fluid home-cover">
	<div class="row">
		<div class="col-xs-12 home-cover-col">
			<div class="title-section">
				<img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr( __( 'Elite Club Training Logo', PersonalTrainerTheme::TEXT_DOMAIN  ) ); ?>" />
				<h1>Elite Club Training</h1>
			</div>
			<div class="subtitle-section">
				<h2><?php echo esc_html( __( 'Consigue tu plan de entrenamiento a medida.', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
				<div class="links">
					<a href="#trainer-filter-container" class="register-now" rel="bookmark"><?php echo esc_html( __( 'Escoge entrenador', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
					<a href="#already-trainer" class="already-trainer" rel="bookmark"><?php echo esc_html( __( 'Ya tengo entrenador', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
					<a href="#more-info" class="more-info" rel="bookmark"><?php echo esc_html( __( 'Más información', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container" id="more-info">
	<div class="row equal-height">
		<div class="col-xs-12">
			<h2 class="text-center">¿Qué te ofrecemos?</h2>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Escoge el entrenador que más te guste</h3>
			<p>Puedes elegir entre cualquiera de los entrenadores de eliteclubtrainer. Todos son independientes entre sí y tiene su propio sitio personalizado.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Obtén tu plan de entrenamiento personalizado</h3>
			<p>Tu entrenador creare un plan personalizado de entrenamiento para ti que podrá cambiar a medida que avances o cambie tu situación personal.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Seguimiento</h3>
			<p>Tu entrenador estará informado continuamente de tus progresos físicos y tu hábitos alimentarios.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Dietas personalizadas</h3>
			<p>Tu entrenador puede asignarte planes de alimentación según tus gustos, objetivos y horarios.</p>
		</div>
<?php if( false ): ?>
		<div class="col-xs-12 col-sm-6">
			<h3>Personaliza el aspecto de tu sitio</h3>
			<p>Además de todo el contenido deportivo personalizado, podrás cambiar en cualquier momento el aspecto de tu sitio: Logo, colores, textos, fotos, vídeos...</p>
		</div>
<?php endif; ?>
		<div class="col-xs-12 col-sm-6">
			<h3>Sistema automatizado de alertas</h3>
			<p>Para que no se te pase, nuestro sistema te notificará automáticamente cualquier acción requerida.</p>
		</div>
	</div>
</div>

<?php $trainers = array(); ?>
<?php $sites = get_sites(); ?>
<?php foreach( $sites as $site ) : ?>
	<?php $users = get_users( array(
		'blog_id' => $site->blog_id,
		'role' => EpointPersonalTrainer::TRAINER_ROLE
	) ); ?>
	<?php
		foreach( $users as $user )
		{
			if( !array_key_exists( $user->ID, $trainers ) )
			{
				$user->sitio = $site;
				$trainers[$user->ID] = $user;
			}
		}
	?>
<?php endforeach; ?>
<?php
$max_price = 500;
$min_price = PHP_INT_MAX;

$max_presential_price = 500;
$min_presential_price = PHP_INT_MAX;

$max_age = 100;
$min_age = PHP_INT_MAX;

$max_experience = 50;
$min_experience = PHP_INT_MAX;

$max_dietetics = 10;
$min_dietetics = 1;

$max_hypertrophy = 10;
$min_hypertrophy = 1;

$max_slimming = 10;
$min_slimming = 1;

$max_examinations = 10;
$min_examinations = 1;

$max_rehab = 10;
$min_rehab = 1;
?>
<?php foreach( $trainers as $trainer ) : ?>
	<?php $trainer->blog_details = get_blog_details( $trainer->sitio->blog_id ); ?>
	<?php
	$blog_logo_id = get_blog_option( $trainer->sitio->blog_id, 'elitetrainersite_header_logo' );
	$first_name = get_user_meta( $trainer->ID, 'first_name', true );
	$last_name = get_user_meta( $trainer->ID, 'last_name', true );
	$trainer->show_name = !empty( $first_name ) ? trim( $first_name . ' ' . $last_name ) : $trainer->display_name;
	$trainer->header = get_blog_option( $trainer->sitio->blog_id, 'elitetrainersite_header_bg_color' );
	$trainer->title = get_blog_option( $trainer->sitio->blog_id, 'elitetrainersite_header_title' );
	$trainer->title_color = get_blog_option( $trainer->sitio->blog_id, 'elitetrainersite_header_title_color' );
	$trainer->subtitle = get_blog_option( $trainer->sitio->blog_id, 'elitetrainersite_header_subtitle' );
	$trainer->subtitle_color = get_blog_option( $trainer->sitio->blog_id, 'elitetrainersite_header_subtitle_color' );

	$trainer->valoration = EpointPersonalTrainer::get_trainer_valoration( $trainer->sitio->blog_id );
	if( is_int( $trainer->valoration ) && $trainer->valoration > 5 )
		$trainer->valoration = 5;

	$trainer_info = EpointPersonalTrainer::get_user_trainer_info( $trainer->ID )->get_attributes();
	$trainer_photo_id = !empty( $trainer_info['public_photo'] ) ? $trainer_info['public_photo'] : null;

	$trainer->online_price = !empty( $trainer_info['online_price'] ) ? (int)$trainer_info['online_price'] : 20;
	$trainer->presential_price = !empty( $trainer_info['presential_price'] ) ? (int)$trainer_info['presential_price'] : 20;
	$trainer->experience = !empty( $trainer_info['experience_years'] ) ? (int)$trainer_info['experience_years'] : 1;
	$trainer->age = !empty( $trainer_info['age'] ) ? (int)$trainer_info['age'] : 18;
	$trainer->sex = !empty( $trainer_info['sex'] ) ? $trainer_info['sex'] : 'v';
	$trainer->province = !empty( $trainer_info['province'] ) ? $trainer_info['province'] : '';
	$trainer->sports = !empty( $trainer_info['sports'] ) ? $trainer_info['sports'] : '';

	$trainer->dietetics = !empty( $trainer_info['dietetics'] ) ? (int)$trainer_info['dietetics'] : 1;
	$trainer->hypertrophy = !empty( $trainer_info['hypertrophy'] ) ? (int)$trainer_info['hypertrophy'] : 1;
	$trainer->slimming = !empty( $trainer_info['slimming'] ) ? (int)$trainer_info['slimming'] : 1;
	$trainer->examinations = !empty( $trainer_info['examinations'] ) ? (int)$trainer_info['examinations'] : 1;
	$trainer->rehab = !empty( $trainer_info['rehab'] ) ? (int)$trainer_info['rehab'] : 1;

	if( $trainer->online_price < $min_price )
		$min_price = $trainer->online_price;
	if( $trainer->online_price > $max_price )
		$max_price = $trainer->online_price;

	if( $trainer->presential_price < $min_presential_price )
		$min_presential_price = $trainer->presential_price;
	if( $trainer->presential_price > $max_presential_price )
		$max_presential_price = $trainer->presential_price;
	
	if( $trainer->experience < $min_experience )
		$min_experience = $trainer->experience;
	if( $trainer->experience > $max_experience )
		$max_experience = $trainer->experience;
	
	if( $trainer->age < $min_age )
		$min_age = $trainer->age;
	if( $trainer->age > $max_age )
		$max_age = $trainer->age;
	
	if( $trainer->dietetics < $min_dietetics )
		$min_dietetics = $trainer->dietetics;
	if( $trainer->dietetics > $max_dietetics )
		$max_dietetics = $trainer->dietetics;
	
	if( $trainer->hypertrophy < $min_hypertrophy )
		$min_hypertrophy = $trainer->hypertrophy;
	if( $trainer->hypertrophy > $max_hypertrophy )
		$max_hypertrophy = $trainer->hypertrophy;
	
	if( $trainer->slimming < $min_slimming )
		$min_slimming = $trainer->slimming;
	if( $trainer->slimming > $max_slimming )
		$max_slimming = $trainer->slimming;
	
	if( $trainer->examinations < $min_examinations )
		$min_examinations = $trainer->examinations;
	if( $trainer->examinations > $max_examinations )
		$max_examinations = $trainer->examinations;
	
	if( $trainer->rehab < $min_rehab )
		$min_rehab = $trainer->rehab;
	if( $trainer->rehab > $max_rehab )
		$max_rehab = $trainer->rehab;

	switch_to_blog( $trainer->sitio->blog_id );
	$trainer->logo_url = $blog_logo_id ? wp_get_attachment_image_url( $blog_logo_id, 'full' ) : null;
	$trainer->public_photo = $trainer_photo_id ? wp_get_attachment_image_url( $trainer_photo_id, 'full' ) : null;
	restore_current_blog();
?>
<?php endforeach; ?>


<style>
<?php foreach( $trainers as $trainer ) : ?>
	<?php if( $trainer->header ) {
		PersonalTrainerTheme::print_bg_rules( '#trainer-slide-' . $trainer->sitio->blog_id, $trainer->header, false );
		PersonalTrainerTheme::print_bg_rules( '#trainer-list-element-' . $trainer->sitio->blog_id . ' .trainer-list-element-inner', $trainer->header, false );
	}
	?>
	<?php if( $trainer->title_color ) {
		PersonalTrainerTheme::print_text_rules( '#trainer-slide-' . $trainer->sitio->blog_id . ' .title', $trainer->title_color, false );
		PersonalTrainerTheme::print_text_rules( '#trainer-list-element-' . $trainer->sitio->blog_id . ' .trainer-list-element-inner .title', $trainer->title_color, true );
		PersonalTrainerTheme::print_text_rules( '#trainer-list-element-' . $trainer->sitio->blog_id . ' .trainer-list-element-inner .prices .price', $trainer->title_color, false );
		PersonalTrainerTheme::print_text_rules( '#trainer-list-element-' . $trainer->sitio->blog_id . ' .trainer-list-element-inner .knowledge p', $trainer->title_color, false );
	}
	?>
	<?php if( $trainer->subtitle_color ) {
		PersonalTrainerTheme::print_text_rules( '#trainer-slide-' . $trainer->sitio->blog_id . ' .subtitle', $trainer->subtitle_color, false );
		PersonalTrainerTheme::print_text_rules( '#trainer-list-element-' . $trainer->sitio->blog_id . ' .trainer-list-element-inner .subtitle', $trainer->subtitle_color, true );
		PersonalTrainerTheme::print_text_rules( '#trainer-list-element-' . $trainer->sitio->blog_id . ' .trainer-list-element-inner .valoration .valorations-link', $trainer->subtitle_color, true );
	}
	?>
<?php endforeach; ?>
</style>

<div class="container-fluid choose-trainer" id="register-layer">
	<div class="row">
		<div class="col-xs-12 choose-col">
			<div id="carousel-choose" class="carousel slide bordered-layer" data-ride="carousel" data-interval="3000">
<?php if( true ) : ?>
				<ol class="carousel-indicators">
					<?php for( $i = 0; $i < count( $trainers ); $i++ ) : ?>
					<li data-target="#carousel-choose" data-slide-to="<?php echo $i; ?>" <?php if( !$i ) : ?>class="active"<?php endif; ?>></li>
					<?php endfor; ?>
				</ol>
<?php endif; ?>
				<div class="carousel-inner" role="listbox">
					<?php $i = 0; ?>
					<?php foreach( $trainers as $trainer ) : ?>
<div
	id="trainer-slide-<?php echo $trainer->sitio->blog_id; ?>"
	class="item <?php if( !$i ) : ?>active<?php endif; ?>  item-<?php echo $i; ?>"
>
	<?php //<div class="carousel-caption text-center"> ?>
	<div class="trainer-item-layer">
		<div class="siteheader">
			<div class="logo-layer">
			<?php if( $trainer->logo_url ) : ?>
				<img class="blog-logo" src="<?php echo $trainer->logo_url; ?>" alt="Logo" />
			<?php else : ?>
				<img class="blog-logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" />
			<?php endif; ?>
			</div>
			<div class="header-text">
			<?php if( !$trainer->title ) : ?>
				<h3><?php echo $trainer->blog_details->blogname; ?></h3>
			<?php else : ?>
				<h3 class="title"><?php echo $trainer->title; ?></h3>
			<?php endif; ?>
				<h4 class="subtitle"><?php echo $trainer->subtitle; ?></h4>
			</div>
		</div>
		<div class="photo <?php if( $trainer->sex == 'm' ) : ?>woman<?php endif; ?>" <?php if( $trainer->public_photo ) : ?>style="background-image:url('<?php echo $trainer->public_photo; ?>');"<?php endif; ?>>
		<?php if( false ) : ?>
			<?php if( !empty( $trainer->valoration ) ) : ?>
				<div class="valoration">
					<div class="stars"
						style="width:<?php echo ceil( 250.0 * (float)$trainer->valoration / 5.0 ); ?>px;"
					></div>
					<p><a data-target="#trainer-<?php echo $trainer->sitio->blog_id; ?>-comments-modal" data-toggle="modal" class="btn btn-primary">Ver valoraciones</a></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		</div>
		<div class="text">
			<h4 class="subtitle"><?php echo $trainer->show_name; ?></h4>
			<div class="prices">
				<p class="price"><?php echo $trainer->online_price; ?> &euro;/mes<br/><small>online</small></p>
				<p class="price"><?php echo $trainer->presential_price; ?> &euro;/mes<br/><small>presencial</small></p>
			</div>
			<div class="knowledge">
				<h4>Conocimientos</h4>
				<div class="bars">
					<p>Dietética</p>
					<div class="bar"><div class="inner" style="width:<?php echo $trainer->dietetics * 10; ?>%;"></div></div>
					<p>Hipertrofia</p>
					<div class="bar"><div class="inner" style="width:<?php echo $trainer->hypertrophy * 10; ?>%;"></div></div>
					<p>Adelgazamiento</p>
					<div class="bar"><div class="inner" style="width:<?php echo $trainer->slimming * 10; ?>%;"></div></div>
					<p>Oposiciones</p>
					<div class="bar"><div class="inner" style="width:<?php echo $trainer->examinations * 10; ?>%;"></div></div>
					<p>Rehabilitación</p>
					<div class="bar"><div class="inner" style="width:<?php echo $trainer->rehab * 10; ?>%;"></div></div>
				</div>
			</div>
			<?php if( !empty( $trainer->valoration ) ) : ?>
				<div class="valoration">
					<div class="stars"
						style="width:<?php echo ceil( 250.0 * (float)$trainer->valoration / 5.0 ); ?>px;"
					></div>
					<p><a data-target="#trainer-<?php echo $trainer->sitio->blog_id; ?>-comments-modal" data-toggle="modal" class="btn btn-primary">Ver valoraciones</a></p>
				</div>
			<?php endif; ?>
			<p><a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>" class="btn btn-primary">Ir al sitio</a></p>
		</div>
	</div>
</div>
					<?php $i++; ?>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="container-fluid trainer-filter-container" id="trainer-filter-container">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2>Filtro de entrenadores</h2>
				<div class="trainer-filters">
					<div class="trainer-filter slider-filter">
						<h5>Edad</h5>
						<div id="trainer-filter-age">
							<div id="trainer-filter-age-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-age-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Experiencia</h5>
						<div id="trainer-filter-experience">
							<div id="trainer-filter-experience-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-experience-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Precio Online</h5>
						<div id="trainer-filter-price">
							<div id="trainer-filter-price-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-price-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Precio Presencial</h5>
						<div id="trainer-filter-presential-price">
							<div id="trainer-filter-presential-price-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-presential-price-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="filters-title">
						<h4>Valoraciones del 1 al 10 <small>(en función del conocimiento de la materia)</small></h4>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Dietética</h5>
						<div id="trainer-filter-dietetics">
							<div id="trainer-filter-dietetics-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-dietetics-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Hipertrofia</h5>
						<div id="trainer-filter-hypertrophy">
							<div id="trainer-filter-hypertrophy-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-hypertrophy-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Adelgazamiento</h5>
						<div id="trainer-filter-slimming">
							<div id="trainer-filter-slimming-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-slimming-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Oposiciones</h5>
						<div id="trainer-filter-examinations">
							<div id="trainer-filter-examinations-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-examinations-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter slider-filter">
						<h5>Rehabilitación</h5>
						<div id="trainer-filter-rehab">
							<div id="trainer-filter-rehab-handle-inf" class="ui-slider-handle"></div>
							<div id="trainer-filter-rehab-handle-sup" class="ui-slider-handle"></div>
						</div>
					</div>
					<div class="trainer-filter">
						<h5>Sexo</h5>
						<div class="form-group">
							<select id="trainer-filter-sex" class="form-control">
								<option value="">Cualquiera</option>
								<option value="v">Varón</option>
								<option value="m">Mujer</option>
							</select>
						</div>
					</div>
					<div class="trainer-filter">
						<h5>Provincia</h5>
						<div class="form-group">
							<select id="trainer-filter-province" class="form-control">
								<option value="">Cualquiera</option>
								<option value="VI">Alava</option>
								<option value="AB">Albacete</option>
								<option value="A">Alicante</option>
								<option value="AL">Almeria</option>
								<option value="O">Asturias</option>
								<option value="AV">Avila</option>
								<option value="BA">Badajoz</option>
								<option value="PM">Baleares</option>
								<option value="B">Barcelona</option>
								<option value="BU">Burgos</option>
								<option value="CC">Caceres</option>
								<option value="CA">Cadiz</option>
								<option value="S">Cantabria</option>
								<option value="CS">Castellon</option>
								<option value="CE">Ceuta</option>
								<option value="CR">Ciudad Real</option>
								<option value="CO">Cordoba</option>
								<option value="CU">Cuenca</option>
								<option value="GI">Gerona</option>
								<option value="GR">Granada</option>
								<option value="GU">Guadalajara</option>
								<option value="SS">Guipuzcoa</option>
								<option value="H">Huelva</option>
								<option value="HU">Huesca</option>
								<option value="J">Jaen</option>
								<option value="C">La Coruña</option>
								<option value="LO">La Rioja</option>
								<option value="GC">Las Palmas</option>
								<option value="LE">Leon</option>
								<option value="L">Lerida</option>
								<option value="LU">Lugo</option>
								<option value="M">Madrid</option>
								<option value="MA">Malaga</option>
								<option value="ML">Melilla</option>
								<option value="MU">Murcia</option>
								<option value="NA">Navarra</option>
								<option value="OR">Orense</option>
								<option value="P">Palencia</option>
								<option value="PO">Pontevedra</option>
								<option value="SA">Salamanca</option>
								<option value="TF">Santa Cruz de Tenerife</option>
								<option value="SG">Segovia</option>
								<option value="SE">Sevilla</option>
								<option value="SO">Soria</option>
								<option value="T">Tarragona</option>
								<option value="TE">Teruel</option>
								<option value="TO">Toledo</option>
								<option value="V">Valencia</option>
								<option value="VA">Valladolid</option>
								<option value="BI">Vizcaya</option>
								<option value="ZA">Zamora</option>
								<option value="Z">Zaragoza</option>
							</select>
						</div>
					</div>
					<div class="trainer-filter">
						<h5>Deportes</h5>
						<div class="form-group">
							<select id="trainer-filter-sport" class="form-control">
								<option value="">Cualquiera</option>
								<option value="athletics">Atletismo</option>
								<option value="swimming">Natación</option>
								<option value="football">Fútbol</option>
								<option value="gymnastics">Gimnasia</option>
								<option value="tennis">Tenis</option>
								<option value="padel">Pádel</option>
								<option value="contact">De contacto</option>
								<option value="golf">Golf</option>
								<option value="climb">Escalada</option>
								<option value="trekking">Senderismo</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<?php foreach( $trainers as $trainer ) : ?>
<div class="modal fade" id="trainer-<?php echo $trainer->sitio->blog_id; ?>-comments-modal" tabindex="-1" role="dialog" aria-labelledby="trainer-<?php echo $trainer->sitio->blog_id; ?>-comments-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="trainer-<?php echo $trainer->sitio->blog_id; ?>-comments-modal-label"><?php echo esc_html( $trainer->blog_details->blogname ); ?></h4>
      </div>
      <div class="modal-body">
		<?php foreach( EpointPersonalTrainer::get_trainer_valoration_comments( $trainer->sitio->blog_id ) as $valoration ) : ?>
			<div class="valoration">
				<?php echo nl2br( esc_html( $valoration ) ); ?>
			</div>
		<?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script type="text/javascript">
(function($){
	var maxAge = <?php echo $max_age; ?>;
	var minAge = <?php echo $min_age; ?>;
	var maxExperience = <?php echo $max_experience; ?>;
	var minExperience = <?php echo $min_experience; ?>;
	var maxPrice = <?php echo $max_price; ?>;
	var minPrice = <?php echo $min_price; ?>;
	var maxPresentialPrice = <?php echo $max_presential_price; ?>;
	var minPresentialPrice = <?php echo $min_presential_price; ?>;
	var maxDietetics = <?php echo $max_dietetics; ?>;
	var minDietetics = <?php echo $min_dietetics; ?>;
	var maxHypertrophy = <?php echo $max_hypertrophy; ?>;
	var minHypertrophy = <?php echo $min_hypertrophy; ?>;
	var maxSlimming = <?php echo $max_slimming; ?>;
	var minSlimming = <?php echo $min_slimming; ?>;
	var maxExaminations = <?php echo $max_examinations; ?>;
	var minExaminations = <?php echo $min_examinations; ?>;
	var maxRehab = <?php echo $max_rehab; ?>;
	var minRehab = <?php echo $min_rehab; ?>;
	var sex = '';
	var province = '';
	var sport = '';
	function epointPersonalTrainerUpdateTrainersList()
	{
		$('.trainer-list-element').each(function(ind,elem){
			var e = $(elem);
			console.log( e.data('age') );
			console.log( e.data('experience') );
			console.log( e.data('online-price') );
			if( e.data('age') <= maxAge &&
				e.data('age') >= minAge &&
				e.data('experience') <= maxExperience &&
				e.data('experience') >= minExperience &&
				e.data('online-price') <= maxPrice &&
				e.data('online-price') >= minPrice &&
				e.data('presential-price') <= maxPrice &&
				e.data('presential-price') >= minPrice &&
				e.data('dietetics') <= maxDietetics &&
				e.data('dietetics') >= minDietetics &&
				e.data('hypertrophy') <= maxHypertrophy &&
				e.data('hypertrophy') >= minHypertrophy &&
				e.data('slimming') <= maxSlimming &&
				e.data('slimming') >= minSlimming &&
				e.data('examinations') <= maxExaminations &&
				e.data('examinations') >= minExaminations &&
				e.data('rehab') <= maxRehab &&
				e.data('rehab') >= minRehab &&
				( sex == '' || sex == e.data('sex') ) &&
				( province == '' || province == e.data('province') ) &&
				( sport == '' || e.data('sport').indexOf(sport) != -1 ) 
			) {
				e.show();
			}
			else
			{
				e.hide();
			}
				
		});
	}

	$(document).ready(function(){
		$( "#trainer-filter-age" ).slider({
		  range: true,
		  min: <?php echo $min_age; ?>,
		  max: <?php echo PersonalTrainerTheme::get_maximum_max( $min_age, $max_age ); ?>,
		  step: <?php echo PersonalTrainerTheme::get_maximum_step( $min_age, $max_age ); ?>,
		  values: [ <?php echo $min_age; ?>, <?php echo $max_age; ?> ],
		  create: function(){
			$('#trainer-filter-age-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-age-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minAge = parseInt(ui.values[0]);
			maxAge = parseInt(ui.values[1]);
			$('#trainer-filter-age-handle-inf').text(ui.values[0]);
			$('#trainer-filter-age-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});
		$( "#trainer-filter-experience" ).slider({
		  range: true,
		  min: <?php echo $min_experience; ?>,
		  max: <?php echo PersonalTrainerTheme::get_maximum_max( $min_experience, $max_experience ); ?>,
		  step: <?php echo PersonalTrainerTheme::get_maximum_step( $min_experience, $max_experience ); ?>,
		  values: [ <?php echo $min_experience; ?>, <?php echo $max_experience; ?> ],
		  create: function(){
			$('#trainer-filter-experience-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-experience-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minExperience = parseInt(ui.values[0]);
			maxExperience = parseInt(ui.values[1]);
			$('#trainer-filter-experience-handle-inf').text(ui.values[0]);
			$('#trainer-filter-experience-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});
		$( "#trainer-filter-price" ).slider({
		  range: true,
		  min: <?php echo $min_price; ?>,
		  max: <?php echo PersonalTrainerTheme::get_maximum_max( $min_price, $max_price ); ?>,
		  step: <?php echo PersonalTrainerTheme::get_maximum_step( $min_price, $max_price ); ?>,
		  values: [ <?php echo $min_price; ?>, <?php echo $max_price; ?> ],
		  create: function(){
			$('#trainer-filter-price-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-price-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minPrice = parseInt(ui.values[0]);
			maxPrice = parseInt(ui.values[1]);
			$('#trainer-filter-price-handle-inf').text(ui.values[0]);
			$('#trainer-filter-price-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});
		$( "#trainer-filter-presential-price" ).slider({
		  range: true,
		  min: <?php echo $min_presential_price; ?>,
		  max: <?php echo PersonalTrainerTheme::get_maximum_max( $min_presential_price, $max_presential_price ); ?>,
		  step: <?php echo PersonalTrainerTheme::get_maximum_step( $min_presential_price, $max_presential_price ); ?>,
		  values: [ <?php echo $min_presential_price; ?>, <?php echo $max_presential_price; ?> ],
		  create: function(){
			$('#trainer-filter-presential-price-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-presential-price-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minPresentialPrice = parseInt(ui.values[0]);
			maxPresentialPrice = parseInt(ui.values[1]);
			$('#trainer-filter-presential-price-handle-inf').text(ui.values[0]);
			$('#trainer-filter-presential-price-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});

		$( "#trainer-filter-dietetics" ).slider({
		  range: true,
		  min: <?php echo $min_dietetics; ?>,
		  max: <?php echo $max_dietetics; ?>,
		  values: [ <?php echo $min_dietetics; ?>, <?php echo $max_dietetics; ?> ],
		  create: function(){
			$('#trainer-filter-dietetics-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-dietetics-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minDietetics = parseInt(ui.values[0]);
			maxDietetics = parseInt(ui.values[1]);
			$('#trainer-filter-dietetics-handle-inf').text(ui.values[0]);
			$('#trainer-filter-dietetics-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});

		$( "#trainer-filter-hypertrophy" ).slider({
		  range: true,
		  min: <?php echo $min_hypertrophy; ?>,
		  max: <?php echo $max_hypertrophy; ?>,
		  values: [ <?php echo $min_hypertrophy; ?>, <?php echo $max_hypertrophy; ?> ],
		  create: function(){
			$('#trainer-filter-hypertrophy-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-hypertrophy-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minHypertrophy = parseInt(ui.values[0]);
			maxHypertrophy = parseInt(ui.values[1]);
			$('#trainer-filter-hypertrophy-handle-inf').text(ui.values[0]);
			$('#trainer-filter-hypertrophy-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});

		$( "#trainer-filter-slimming" ).slider({
		  range: true,
		  min: <?php echo $min_slimming; ?>,
		  max: <?php echo $max_slimming; ?>,
		  values: [ <?php echo $min_slimming; ?>, <?php echo $max_slimming; ?> ],
		  create: function(){
			$('#trainer-filter-slimming-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-slimming-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minSlimming = parseInt(ui.values[0]);
			maxSlimming = parseInt(ui.values[1]);
			$('#trainer-filter-slimming-handle-inf').text(ui.values[0]);
			$('#trainer-filter-slimming-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});

		$( "#trainer-filter-examinations" ).slider({
		  range: true,
		  min: <?php echo $min_examinations; ?>,
		  max: <?php echo $max_examinations; ?>,
		  values: [ <?php echo $min_examinations; ?>, <?php echo $max_examinations; ?> ],
		  create: function(){
			$('#trainer-filter-examinations-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-examinations-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minExaminations = parseInt(ui.values[0]);
			maxExaminations = parseInt(ui.values[1]);
			$('#trainer-filter-examinations-handle-inf').text(ui.values[0]);
			$('#trainer-filter-examinations-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});

		$( "#trainer-filter-rehab" ).slider({
		  range: true,
		  min: <?php echo $min_rehab; ?>,
		  max: <?php echo $max_rehab; ?>,
		  values: [ <?php echo $min_rehab; ?>, <?php echo $max_rehab; ?> ],
		  create: function(){
			$('#trainer-filter-rehab-handle-inf').text($(this).slider('values')[0]);
			$('#trainer-filter-rehab-handle-sup').text($(this).slider('values')[1]);
		  },
		  slide: function( event, ui ) {
			//$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			minRehab = parseInt(ui.values[0]);
			maxRehab = parseInt(ui.values[1]);
			$('#trainer-filter-rehab-handle-inf').text(ui.values[0]);
			$('#trainer-filter-rehab-handle-sup').text(ui.values[1]);
			epointPersonalTrainerUpdateTrainersList();
		  }
		});

		$( "#trainer-filter-sex" ).change(function(evt){
			sex = $(evt.currentTarget).val();
			epointPersonalTrainerUpdateTrainersList();
		});

		$( "#trainer-filter-province" ).change(function(evt){
			province = $(evt.currentTarget).val();
			epointPersonalTrainerUpdateTrainersList();
		});

		$( "#trainer-filter-sport" ).change(function(evt){
			sport = $(evt.currentTarget).val();
			epointPersonalTrainerUpdateTrainersList();
		});
	});
})(jQuery);
</script>

<?php uasort( $trainers, function( $a, $b ){ $va = !empty( $a->valoration ) ? (float)$a->valoration : 0.0; $vb = !empty( $b->valoration ) ? (float)$b->valoration : 0.0; return $vb - $va;} ); ?>
<div class="container trainers-list-container">
	<div class="row">
		<div class="col-xs-12 trainers-list-col">
			<div class="trainers-list">
			<?php foreach( $trainers as $trainer ) : ?>
				<div
					class="trainer-list-element"
					id="trainer-list-element-<?php echo $trainer->sitio->blog_id; ?>"
					data-age="<?php echo esc_attr( $trainer->age ); ?>"
					data-sex="<?php echo esc_attr( $trainer->sex ); ?>"
					data-asport="[<?php echo is_array( $trainer->sports ) ? implode( ',', $trainer->sports ) : ''; ?>]"
					data-sport="<?php echo esc_attr( json_encode( $trainer->sports ) ); ?>"
					data-province="<?php echo esc_attr( $trainer->province ); ?>"
					data-online-price="<?php echo esc_attr( $trainer->online_price ); ?>"
					data-presential-price="<?php echo esc_attr( $trainer->presential_price ); ?>"
					data-experience="<?php echo esc_attr( $trainer->experience ); ?>"
					data-dietetics="<?php echo esc_attr( $trainer->dietetics ); ?>"
					data-hypertrophy="<?php echo esc_attr( $trainer->hypertrophy ); ?>"
					data-slimming="<?php echo esc_attr( $trainer->slimming ); ?>"
					data-examinations="<?php echo esc_attr( $trainer->examinations ); ?>"
					data-rehab="<?php echo esc_attr( $trainer->rehab ); ?>"
				>
					<div class="trainer-list-element-inner">
						<?php if( $trainer->logo_url ) : ?>
							<a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>"><img class="blog-logo" src="<?php echo $trainer->logo_url; ?>" alt="Logo" /></a>
						<?php else : ?>
							<a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>"><img class="blog-logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" /></a>
						<?php endif; ?>
						<a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>" class="title"><h3><?php echo $trainer->title ? $trainer->title : $trainer->blog_details->blogname; ?></h3></a>
						<div class="photo <?php if( $trainer->sex == 'm' ) : ?>woman<?php endif; ?>" <?php if( $trainer->public_photo ) : ?>style="background-image:url('<?php echo $trainer->public_photo; ?>');"<?php endif; ?>></div>
						<a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>" class="subtitle"><h4><?php echo $trainer->subtitle; ?></h4></a>
						<a href="<?php echo get_site_url( $trainer->sitio->blog_id ); ?>" class="subtitle"><h4><?php echo $trainer->show_name; ?></h4></a>
						<div class="prices">
							<p class="price"><?php echo $trainer->online_price; ?> &euro;/mes<br/><small>online</small></p>
							<p class="price"><?php echo $trainer->presential_price; ?> &euro;/mes<br/><small>presencial</small></p>
						</div>
						<div class="knowledge">
							<div class=bars">
								<p>Dietética</p>
								<div class="bar"><div class="inner" style="width:<?php echo $trainer->dietetics * 10; ?>%;"></div></div>
								<p>Hipertrofia</p>
								<div class="bar"><div class="inner" style="width:<?php echo $trainer->hypertrophy * 10; ?>%;"></div></div>
								<p>Adelgazamiento</p>
								<div class="bar"><div class="inner" style="width:<?php echo $trainer->slimming * 10; ?>%;"></div></div>
								<p>Oposiciones</p>
								<div class="bar"><div class="inner" style="width:<?php echo $trainer->examinations * 10; ?>%;"></div></div>
								<p>Rehabilitación</p>
								<div class="bar"><div class="inner" style="width:<?php echo $trainer->rehab * 10; ?>%;"></div></div>
							</div>
						</div>
						<?php if( !empty( $trainer->valoration ) ) : ?>
							<div class="valoration">
								<div class="stars"
									style="width:<?php echo ceil( 150.0 * (float)$trainer->valoration / 5.0 ); ?>px;"
								></div>
								<p><a data-target="#trainer-<?php echo $trainer->sitio->blog_id; ?>-comments-modal" data-toggle="modal" class="valorations-link">Ver valoraciones</a></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
			</div>	
		</div>
	</div>
</div>

<div class="container trainers-list-container" id="already-trainer">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<?php if( false ) : ?>
				<?php if( !is_user_logged_in() ||
						 !( $user = wp_get_current_user() ) ||
						 !( $blogs = get_blogs_of_user( $user->ID ) ) ) : ?>
					<h2 class="text-center">¿Ya tienes entrenador?</h2>
					<p class="text-center">Introduce tu correo electrónico y tu contraseña para acceder directamente al sitio de tu entrenador.</p>
					<?php echo do_shortcode( '[epoint_personal_trainer_client_already_trainer /]' ); ?>
				<?php else : ?>
					<?php if( empty( $blogs ) ) : ?>
						<h2 class="text-center">No tiene espacios web registrados</h2>
					<?php else : ?>
						<hr />
						<h2 class="text-center">Tus sitios</h2>
						<?php foreach( $blogs as $blog ) : ?>
							<p class="text-center"><a class="btn btn-lg btn-primary" href="<?php echo $blog->siteurl; ?>" rel="bookmark">Ir a <?php echo esc_html( $blog->blogname ); ?></a></p>
							<hr />
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			<h2 class="text-center">¿Ya tienes entrenador?</h2>
			<p class="text-center">Si conoces o tienes entrenador/ra, escribe aquí el nombre de su espacio web y seras derivado directamente.</p>
			<?php echo do_shortcode( '[epoint_personal_trainer_client_search_trainer /]' ); ?>
		</div>
	</div>
</div>

<?php if( false ) : ?>
<div class="container trainers-list-container" id="already-trainer2">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<?php if( false ) : ?>
				<?php if( !is_user_logged_in() ||
						 !( $user = wp_get_current_user() ) ||
						 !( $blogs = get_blogs_of_user( $user->ID ) ) ) : ?>
					<h2 class="text-center">¿Ya tienes entrenador?</h2>
					<p class="text-center">Introduce tu correo electrónico y tu contraseña para acceder directamente al sitio de tu entrenador.</p>
					<?php echo do_shortcode( '[epoint_personal_trainer_client_already_trainer /]' ); ?>
				<?php else : ?>
					<?php if( empty( $blogs ) ) : ?>
						<h2 class="text-center">No tiene espacios web registrados</h2>
					<?php else : ?>
						<hr />
						<h2 class="text-center">Tus sitios</h2>
						<?php foreach( $blogs as $blog ) : ?>
							<p class="text-center"><a class="btn btn-lg btn-primary" href="<?php echo $blog->siteurl; ?>" rel="bookmark">Ir a <?php echo esc_html( $blog->blogname ); ?></a></p>
							<hr />
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			<h2 class="text-center">¿Ya tienes entrenador?</h2>
			<p class="text-center">Si conoces o tienes entrenador/ra, escribe aquí el nombre de su espacio web y seras derivado directamente.</p>
			<?php echo do_shortcode( '[epoint_personal_trainer_client_search_trainer /]' ); ?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
