<?php /* Template Name: Trainer Landing */
defined('ABSPATH') or die( 'Wrong Access' );
?><?php get_header('noopen'); ?>
<div class="container-fluid home-cover">
	<div class="row">
		<div class="col-xs-12 home-cover-col">
			<div class="title-section">
				<img class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr( __( 'Elite Club Training Logo', PersonalTrainerTheme::TEXT_DOMAIN  ) ); ?>" />
				<h1>Elite Club Training</h1>
			</div>
			<div class="subtitle-section">
				<h2><?php echo esc_html( __( 'Get your Own Online Gym', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></h2>
				<div class="links">
					<a href="#" class="register-trainer-now" rel="bookmark"><?php echo esc_html( __( 'Create now', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
					<a href="#" class="register-trainer-now" rel="bookmark"><?php echo esc_html( __( 'Ya tengo mi espacio web', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
					<a href="#" class="more-info" rel="bookmark"><?php echo esc_html( __( 'More info', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container" id="more-info">
	<div class="row equal-height">
		<div class="col-xs-12">
			<h2 class="text-center">¿Qué te ofrecemos?</h2>
            <div class="video-layer">
                <iframe width="100%" height="650px" src="https://www.youtube.com/embed/yhtI6UkilRs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
		</div>

		<div class="col-xs-12 col-sm-6">
			<h3>Espacio web propio</h3>
			<p>Una vez registrado, dispondrás de un espacio web propio para tus clientes.</p>
			<p>Nosotros nos encargamos de la creación y el mantenimiento del sitio, sólo tendrás que elegir el nombre del dominio.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Amplia galería de ejercicios</h3>
			<p>Ponemos a tu disposición una amplia variedad de ejercicios prefefinidos para elaborar planes de entrenamiento.</p>
			<p>También puedes crear tus propios ejercicios, e incluir un video para cada uno de ellos, fotos de inicio y finalización.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Crea planes de entrenamiento personalizados</h3>
			<p>Además de asignar planes personalizados para cada cliente, dispondrás de tu propia biblioteca de entrenamientos para agilizar su gestión.</p>
			<p>Podrás duplicar cualquier plan y modificar lo que sea necesario para asignarselo a un cliente, ahorrando una gran cantidad de tiempo.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Seguimiento del cliente</h3>
			<p>Tus clientes dispondrán de un sencillo sistema donde actualizar su peso, medidas y fotos periódicamente.</p>
			<p>También dispondrás de graficas para observar su evolución, de pruebas físicas para opositores y diferentes pruebas atléticas que tu mismo podrás editar según las necesidades de tus clientes.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Crea dietas personalizadas</h3>
			<p>También dispondras de una galería para almacenar dietas predefinidas por ti mismo. Así podrás generar dietas personalizadas para cada cliente rápidamente.</p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h3>Personaliza el aspecto de tu sitio</h3>
			<p>Además de todo el contenido deportivo personalizado, podrás cambiar en cualquier momento el aspecto de tu sitio: Logo, colores, textos, fotos, vídeos...</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<h3>Sistema automatizado de alertas</h3>
			<p>El sistema notificará automáticamente cualquier acción requerida, tanto para ti como para tus clientes.</p>
		</div>
	</div>
</div>
<div class="container" id="register-layer">
	<?php if( false ) : ?>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3 text-center">
			<h2 class="text-center">¿Ya tienes tu espacio web?</h2>
			<a class="btn btn-primary btn-lg" href="<?php echo get_permalink( get_option( PersonalTrainerTheme::SPORTSMAN_LANDING_PAGE_KEY ) ); ?>" rel="bookmark">Accede desde aquí</a>
		</div>
	</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<h2 class="text-center">Ya tengo mi espacio web</h2>
			<?php if( !is_user_logged_in() ||
					 !( $user = wp_get_current_user() ) ||
					 !( $blogs = get_blogs_of_user( $user->ID ) ) ) : ?>
				<?php echo do_shortcode( '[epoint_personal_trainer_already_trainer /]' ); ?>
			<?php else : ?>
				<?php if( empty( $blogs ) ) : ?>
					<h2 class="text-center">No tiene espacios web registrados</h2>
				<?php else : ?>
					<hr />
					<?php foreach( $blogs as $blog ) : ?>
						<p class="text-center"><a class="btn btn-lg btn-primary" href="<?php echo $blog->siteurl; ?>" rel="bookmark">Ir a <?php echo esc_html( $blog->blogname ); ?></a></p>
						<hr />
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 col-sm-6">
			<h2 class="text-center">Registrate ahora</h2>
			<?php echo do_shortcode( '[epoint_personal_trainer_register_trainer /]' ); ?>
		</div>
	</div>
</div>

<?php get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
