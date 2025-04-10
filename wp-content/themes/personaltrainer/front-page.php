<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
add_filter( 'navbar-default-extra-classes', function( $classes ){ $classes[] = 'transparent';return $classes; } );
add_filter( 'body_class', function( $classes ){ $classes[] = 'no-padding';return $classes; } );
?><?php
get_header('noopen');
?>
<div class="container-fluid home-cover">
	<div class="row">
		<div class="col-xs-12 home-cover-col">
			<div class="title-section">
				<img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr( __( 'Elite Club Training Logo', PersonalTrainerTheme::TEXT_DOMAIN  ) ); ?>" />
				<h1>Elite Club Training</h1>
			</div>
			<div class="subtitle-section">
				<h2><?php echo esc_html( __( 'Online Training Management', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
				<div class="links">
					<a href="<?php echo get_permalink( get_option( PersonalTrainerTheme::TRAINER_LANDING_PAGE_KEY ) ); ?>" rel="bookmark"><?php echo esc_html( __( 'I am a trainer', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
					<a href="<?php echo get_permalink( get_option( PersonalTrainerTheme::SPORTSMAN_LANDING_PAGE_KEY ) ); ?>" rel="bookmark"><?php echo esc_html( __( 'I am looking for a trainer', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<p class="text-center h3">Si eres un entrenador, encontrarás más información pinchando en el botón "Soy un entrenador" de arriba.</p>
			<p class="text-center h3">Si estás buscando un entrenador, pincha en el "Busco entrenador" y serás derivado a nuestro filtro de entrenadores.</p>
			<br />
			<br />
			<hr />
		</div>
	</div>
</div>

<div class="container-fluid chose">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 chose-col">
				<div class="titles">
					<h2>Elige tu entrenador personal</h2>
					<h3>Puedes escoger cualquiera de los entrenadores de nuestra comunidad. Cada uno cuenta con su espacio propio.</h3>
				</div>

			</div>
		</div>
	</div>
</div>

<?php if( false ) : ?>
<div class="container technology">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<h2><?php echo esc_html( __( 'Available For All Devices', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
			<img class="devices" src="<?php echo get_template_directory_uri(); ?>/img/icons/devices.png" alt="<?php echo esc_attr( __( 'Any device', PersonalTrainerTheme::TEXT_DOMAIN  ) ); ?>" />
			<h3><?php echo esc_html( __( 'Access your train routines everywhere', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h3>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h2><?php echo esc_html( __( 'Compatible with Google Fit', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
			<img class="devices" src="<?php echo get_template_directory_uri(); ?>/img/icons/google_fit.png" alt="<?php echo esc_attr( __( 'Google Fit', PersonalTrainerTheme::TEXT_DOMAIN  ) ); ?>" />
		</div>
	</div>
</div>
<?php endif; ?>

<div class="container live">
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo esc_html( __( 'Available for live sessions', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
			<h3><strong><?php bloginfo( 'name' ); ?></strong> también ofrece <strong>entrenamiento presencial</strong>:</h3>
		</div>
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
			<ul class="cool-big-list">
				<li>Plan dietético a medida</li>
				<li>Entrenamiento personal</li>
				<li>Medición y control de peso semanal</li>
				<li>Fotografías de evolución mensual</li>
				<li>Atención teléfonica</li>
				<li>Sesión de fisioterapia mensual</li>
			</ul>
            <p style="text-align: center;">(Depende del entrenador que elijas)</p>
		</div>
	</div>
</div>

<?php get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer('noclose'); ?>
