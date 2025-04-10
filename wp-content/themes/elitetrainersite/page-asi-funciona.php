<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<?php EliteTrainerSiteThemeCustomizer::print_page_header_video(
	'howworkspagetitle2',
	'Así funciona Elite Club Training',
	'howworksheadervideo',
	'howworkspagesubtitle',
	'Tu entrenamiento siempre disponible'
); ?>
<div class="container-fluid how-works-container">
	<div class="container">
<?php if( false ) : ?>
		<div class="row">
			<div class="col-xs-12 how-works-title-col">
				<h1 class="text-center"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'howworkspagetitle', 'Así funciona Elite Club Training' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagetitle' ); ?></h1>
			</div>
		</div>
<?php endif; ?>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-1-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection1content', '<p>Está claro que cualquier tipo de curso, oposición, estudio y como no,  el deporte, exige una disciplina y motivación constantes. Es por ello, que si se tiene posibilidad de hacerlo de forma presencial, nos aseguramos que en esos momento de flaqueza, duda o desmotivación, tengamos ahí, a un profesional que tire de nosotros y nos haga superarnos día a día.</p><p>No obstante, hay muchas personas que por diferentes motivos no pueden realizarlo así y tienen que hacerlo a distancia. Es aquí donde entra en juego nuestra web ELITECLUBTRAINING. Dijo un sabio, todo lo que podamos y queramos cambiar, cámbialo y lo que no, déjalo fluir.</p><p>No pierdas tu tiempo en intentar controlar cosas que no están en tu mano. Si eres una de esas personas que no pueden contar con un entrenador personal de forma presencial, no te preocupes, déjalo pasar y céntrate en todo que podemos hacer por ti por mediación de esta gran web. Más adelante explicamos de forma resumida las diferentes partes que la componen.</p><p>En ésta plataforma web se compone de 3  importantes partes que resumimos a continuación.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection1content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection1image', get_template_directory_uri() . '/img/howworks/picture1.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-2-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'howworkspagesection2title', 'Zona de alimentación' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection2title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'howworkspagesection2video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection2content', '<p>Aquí archivaremos tus gustos por los alimentos, los cuales tú mismo podrás modificar siempre que necesites</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection2content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection2image', get_template_directory_uri() . '/img/howworks/picture2.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-3-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection3content', '<p>Archivaremos tus hábitos actuales de comidas, horarios de trabajo, tiempo libre, etc... los cuales podrás modificar siempre que sea necesario </p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection3content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection3image', get_template_directory_uri() . '/img/howworks/picture3.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-4-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection4content', '<p>Archivaremos todos los planes de alimentación que te creemos, todos con fechas de inicio y fin. Todas las dietas tendrán un nombre que las identifique fácilmente y puedas ver cuando quieras.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection4content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection4image', get_template_directory_uri() . '/img/howworks/picture4.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-5-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'howworkspagesection5title', 'Zona de entrenamientos' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection5title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'howworkspagesection5video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection5content', '<p>Aquí archivaremos todos tus entrenamientos, con fechas de inicio y fin. Todos los entrenamientos tendrán un nombre asignado que los identifique fácilmente y puedas ver cuándo quieras.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection5content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection5image', get_template_directory_uri() . '/img/howworks/picture5.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-6-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection6content', '<p>Aquí archivaremos todos tus entrenamientos, con los nombres de los ejercicios, series, repeticiones, pesos, etc.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection6content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection6image', get_template_directory_uri() . '/img/howworks/picture6.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-7-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection7content', '<p>Éstos ejercicios serán explicados con fotografías, textos y vídeos tutoriales.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection7content' ); ?>
				</div>


				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection7image1', get_template_directory_uri() . '/img/howworks/picture7.jpg' ); ?>
				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection7image2', get_template_directory_uri() . '/img/howworks/picture8.jpg' ); ?>
				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection7image3', get_template_directory_uri() . '/img/howworks/picture9.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-8-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'howworkspagesection8title', 'Zona de evolución' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection8title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'howworkspagesection8video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection8content', '<p>Aquí archivaremos tu peso y medidas corporales (brazos, piernas, hombros, cintura, etc). Estos datos podrán verse en forma de gráficas evolutivas. Junto a estos datos podrás comunicarnos alguna observación en base a los resultados obtenidos.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection8content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection8image1', get_template_directory_uri() . '/img/howworks/picture10.jpg' ); ?>
				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection8image2', get_template_directory_uri() . '/img/howworks/picture11.jpg' ); ?>
				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection8image3', get_template_directory_uri() . '/img/howworks/picture12.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-9-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection9content', '<p>No te preocupes si dudas en cómo tomarte medidas, aquí te lo mostramos de una forma gráfica y sencilla.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection9content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection9image', get_template_directory_uri() . '/img/howworks/picture13.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-10-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection10content', '<p>Archivaremos tus fotografías mes a mes y así podremos comprobar tu evolución. </p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection10content' ); ?>
				</div>

				<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'howworkssection10image', get_template_directory_uri() . '/img/howworks/picture14.jpg' ); ?>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 how-works-section-col how-works-section-11-col">
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'howworkspagesection11content', '<h3>Todos éstos datos serán completamente privados.</h3><p>Gracias a todos éstos datos, podremos realizar y mantener tu plan de entrenamiento y alimentación totalmente personalizado según las necesidades de cada momento, evolución, objetivos, posibilidades, etc.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'howworkspagesection11content' ); ?>
				</div>
			</div>
		</div>

	</div>
</div>


<?php if( class_exists( 'JLCContact' ) ) : ?>
<?php $phone = esc_attr( EliteTrainerSiteThemeCustomizer::get_contact_phone() ); ?>
<div class="container-fluid contact-container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
			<div class="link-layer">
				<p class="link"><a href="#"><span class="text-inner"><?php echo esc_html(  EliteTrainerSiteThemeCustomizer::get_button_text( 'contact' ) ); ?></span> <span class="glyphicon glyphicon-chevron-right"></span></a></p>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'contactlink' ); ?>
			</div>
			<p class="tel">¡También puedes contactar por teléfono!</p>
			<p class="tel">
				<a class="tel-link" href="tel:<?php echo preg_replace( '/\D/', '', esc_attr( $phone ) ); ?>" rel="nofollow" >Llámanos</a> o
				<?php if( false ) : ?><a class="whatsapp-link" href="whatsapp://send/?phone=<?php echo preg_replace( '/\D/', '', esc_attr( $phone ) ); ?>&text&source&data&app_absent" rel="nofollow" >envía un Whatsapp</a><?php endif; ?>
				<a class="whatsapp-link" href="https://api.whatsapp.com/send?phone=+34<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow">envía un Whatsapp</a> 
			</p>
			<p class="tel">O si lo prefieres <a href="#" rel="nofollow" data-toggle="modal" data-target="#we-call-you-modal"> te llamamos</a></p>
			<div class="contact-form-layer">
				<?php echo JLCContact::get_contact_form(); ?>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'footercontactform' ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_footer('noclose'); ?>

