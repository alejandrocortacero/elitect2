<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php
get_header('noopen');
?>

<?php EliteTrainerSiteThemeCustomizer::print_page_header_video(
	'onlineplanpagetitle',
	'Seguimiento a distancia personalizado dietetico-deportivo',
	'onlineheadervideo',
	'onlineplanpagesubtitle',
	'Tu entrenamiento siempre disponible'
); ?>

<div class="container-fluid online-plan-content-container">
	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-4 online-col-0a">
				
				<div class="section-text" style="position:relative;">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'onlineplanpagesection0acontent', '<p>Entrenamientos 100% personalizados según tus horarios, objetivos, limitaciónes físicas, etc...</p> <p>Planes de alimentación realizados a medida (nos adaptamos a tus necesidades).</p> <p>Seguimientos de evolución/resultados semanales, realizaremos cambios en tu plan de alimentación y/o entrenamiento según tus necesidades, objetivos, horarios, etc...</p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection0acontent' ); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="mini-price-layer">
					<div class="top">
						<?php //EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplan' ); ?>
						<p class="h1 text-center"><span class="price"><?php echo esc_html( EliteTrainerSiteThemeCustomizer::get_online_plan_price() ); ?></span> €</p>
					</div>
					<div class="bottom">
<!--						<a class="join-now" href="#">--><?php //echo esc_html( EliteTrainerSiteThemeCustomizer::get_button_text( 'knowonlinelink', 'Saber más' ) ); ?><!--</a>-->
						<?php //EliteTrainerSiteThemeCustomizer::print_edit_button( 'knowonlinelink' ); ?>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-4 online-col-0b">
				
				<div class="section-text" style="position:relative;">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'onlineplanpagesection0bcontent', '<p>Éste precio abarca todo el seguimiento dietético deportivo a distancia durante 1 mes.</p> <p>Si le interesa conocer los diferentes seguimientos presenciales pinche </p>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection0bcontent' ); ?>
				</div>
				<div style="position:relative;text-align:center;">
					<a class="topresencial" href="<?php echo get_permalink( get_option( EliteTrainerSiteTheme::PRESENCIAL_SYSTEM_PAGE_KEY ) ); ?>"><span class="inner-text"><?php echo esc_html(  EliteTrainerSiteThemeCustomizer::get_button_text( 'onlinetopresenciallink', 'aquí') ); ?></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
					<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlinetopresenciallink' ); ?>
				</div>
			</div>

			<div class="col-xs-12">
				<p><small>El cobro se efectuará el mismo día en el que se realice el primer pago.</small></p>
				<p><small>En caso de solicitar la baja de dicho servicio, deberá notificarlo antes del día 15 en los números de contacto que aparece al inicio de la web.</small></p>
			</div>

		</div>

		<div class="row">
			<div class="col-xs-12 online-plan-section-col online-plan-section-1-col">
				<h2 class="section-title" style="position:relative;"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'onlineplanpagesection1title', 'Alimentación' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection1title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'onlineplansection1video' ); ?>
				<div class="section-text" style="position:relative;">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'onlineplanpagesection1content', '<ul> <li>Las dietas serán preparadas según tus gustos. Puntuarás del 1 al 10 un listado con mas de 100 alimentos, pudiendo añadir los que no aparezcan en esta lista y quieras incluir como posible alimento.</li> <li>Se cambiará de forma quincenal, según los objetivos conseguidos.</li> <li>Se atenderán consultas y dudas por mediación de mensajes.</li> <li>Nunca utilizaremos alimentos que no t gusten.</li> <li>Adaptaremos los alimentos que te gusten a tu disponibilidad horaria</li> <li>Conseguiremos generar nuevas hábitos dieteticos, no realizaremos simplemente una dieta puntual.</li> </ul>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection1content' ); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 online-plan-section-col online-plan-section-2-col">
				<h2 class="section-title" style="position:relative;"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'onlineplanpagesection2title', 'Entrenamiento' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection2title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'onlineplansection2video' ); ?>
				<div class="section-text" style="position:relative;">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'onlineplanpagesection2content', '<ul> <li>Según tus objetivos, tiempo disponible y equipo existente o no, será realizado el entrenamiento.</li> <li>Este entrenamiento será explicado por medio de fotografías, videos tutoriales y textos explicativos.</li> <li>Realizaremos cambios de forma quincenal.</li> </ul>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection2content' ); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 online-plan-section-col online-plan-section-3-col">
				<h2 class="section-title" style="position:relative;"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( 'onlineplanpagesection3title', 'Evolución' ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection3title' ); ?></h2>
				<?php EliteTrainerSiteThemeCustomizer::print_page_video( 'onlineplansection3video' ); ?>
				<div class="section-text" style="position:relative;">
					<div class="editable">
					<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'onlineplanpagesection3content', '<ul> <li>Cada 2 semanas revisaremos tu evolución por medio de peso y medidas corporales, también por medio de las tres fotografías que te pedimos (son totalmente personales) en pantalón corto si eres hombre y top en caso de mujer.</li> <li>Esta evolución será contrastada y según tu evolución se realizará los cambios o modificaciones necesarios.</li> </ul>' ) ); ?>
					</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'onlineplanpagesection3content' ); ?>
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
