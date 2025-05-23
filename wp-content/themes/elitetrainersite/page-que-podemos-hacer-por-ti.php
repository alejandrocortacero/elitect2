<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>
<div class="container-fluid for-you-container first-container">
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'pagebg' ); ?>
	<div class="container">

		<div class="row">
			<div class="col-xs-12 for-you-title-col">
				<h1 class="text-center"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'foryoupagetitle', '¿Qué podemos hacer por ti?' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagetitle' ); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 for-you-section-col for-you-section-1-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'foryoupagesection1title', '1 - A nivel entrenamiento' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection1title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'foryoupagesection1video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'foryoupagesection1content', '<p>Todos y cada uno de nuestros entrenamientos son HECHOS A MEDIDA , según tus objetivos, tiempo disponible, limitaciones físicas, trayectoria deportiva, equipo deportivo disponible y lugar de entrenamiento.</p><p>Es muy importante que el entrenamiento se adapte a ti y no a la inversa.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection1content' ); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 for-you-section-col for-you-section-2-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'foryoupagesection2title', '2 - ¿Cómo explicamos los entrenamientos?' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection2title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'foryoupagesection2video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'foryoupagesection2content', '<p>Por mediación de fotografías, textos y vídeos tutoriales.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection2content' ); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 for-you-section-col for-you-section-3-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'foryoupagesection3title', '3 - ¿Cómo conocemos tu nivel deportivo?' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection3title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'foryoupagesection3video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'foryoupagesection3content', '<p>Por mediación de varios formularios muy detallados, fotografías y demás detalles personales que nos puedas facilitar.</p><p>Si tienes posibilidad y vives en Madrid o cercanías, podrías solicitar una clase con uno/a de nuestros entrenadores, en nuestras instalaciones en Alcalá de henares o en tu propia vivienda y realizar un test físico-articular, por el cual, conoceremos de forma exacta el nivel del que partimos.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection3content' ); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 for-you-section-col for-you-section-4-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'foryoupagesection4title', '4 - Alimentación' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection4title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'foryoupagesection4video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'foryoupagesection4content', '<p>Ya habrás oído en repetidas ocasiones que la alimentación es lo más importante. Pues sí, es muy cierto, pero para poder cumplir (con éxito) un plan de alimentación deportivo , hay que tener algo muy muy en cuenta: NUESTROS GUSTOS POR LOS ALIMENTOS, DISPONIBILIDAD ECONÓMICA, NUESTROS HORARIOS Y TIPO DE TRABAJO.</p><p>Cada uno de nosotros tenemos unos gustos, una cierta disponibilidad horaria y depende del tipo de trabajo que tengamos (podemos comer tranquilamente o solo podemos ingerir líquidos, tiene q ser algo rápido o sobre la marcha etc).</p><p>Si alguno de estos factores no se tiene en cuenta, no estamos cambiando hábitos dietéticos, si no realizando una dieta puntual a la que le pondremos fecha de inicio y final.</p><p>Durante este tiempo nos esforzaremos para adaptarnos a esa fantástica dieta, que promete resultados casi mágicos, pero... ¿cuánto tiempo podemos comer alimentos que no nos gustan, no se adapten a nuestros horarios, incómodos de tomar según nuestro puesto de trabajo o demasiado caros?. Lo mejor para no hacer ni dejar una dieta, es aprender alimentarte de forma adaptada a tus necesidades en todos los sentidos.</p><p>Con nuestros tutoriales aprenderás día a día a utilizar los alimentos en función de sus componentes nutricionales (y por supuesto su sabor) y elegir los que mejor te convengan según el momento, precio, objetivos, etc.</p><p>Aprenderás a leer las etiquetas de los alimentos y la industria alimentaria, no podrá utilizar tu desconocimiento, para que con la simple palabra light, pienses que lo que tomas es saludable.</p><p>Por supuesto que este aprendizaje es voluntario y si lo que prefieres es que nosotros te preparemos tu plan de alimentación a medida, según lo descrito anteriormente y realicemos las modificaciones necesarias de los alimentos o cantidades de estos, según tus gustos, objetivos y necesidades en general, así será por supuesto.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection4content' ); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 for-you-section-col for-you-section-5-col">
				<h2 class="section-title"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'foryoupagesection5title', '5 - Motivación' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection5title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'foryoupagesection5video' ); ?>
				<div class="section-text">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'foryoupagesection5content', '<p>Todas las semanas  cambiaremos parte del entrenamiento, para que así el organismo siempre tenga que luchar por adaptarse a algo nuevo y así evitar que caiga en rutina.</p><p>Una vez el músculo se adapta al ejercicio, éste deja de progresar. Así también evitaremos el aburrimiento que genera  entrenar siempre igual.</p><p>Todas las semanas necesitamos ver tu peso corporal en ayunas y sin ropa.</p><p>Cada 2 semanas necesitamos medidas corporales.</p><p>Cada mes, 3 fotografías (esto es opcional, pero nos es de gran ayuda, son fotografías totalmente privadas) y así poder comprobar la composición corporal.</p><p>Recordemos que el peso es importante, pero más aún lo es la composición de este. Un atleta puede pesar 85 kg con un 6% de grasa, mientras que una persona sedentaria con la misma altura y peso, puede estar en más de un 30% de grasa.</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'foryoupagesection5content' ); ?>
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
