<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php

update_blog_option( null, EliteTrainerSiteTheme::NOT_SHOW_TRAINER_HELP_KEY, 'yes' );

add_filter( 'body_class', function( $classes ){ $classes[] = 'page-trainer-help'; return $classes; } );

get_header('noopen');
?>
<div class="container help-container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center">Ayuda</h1>
		</div>
	</div>
	<div class="row index-row">
		<div class="col-xs-12">
			<h2>Funciones de personalización</h2>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="1" data-title="Activar personalización">Activar personalización</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="2" data-title="Personalizar cabecero/logo/nombre">Personalizar cabecero/logo/nombre</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="3" data-title="Personalizar textos y colores web">Personalizar textos y colores web</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="4" data-title="Personalizar fotos web">Personalizar fotos web</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="5" data-title="Personalizar vidios web">Personalizar vidios web</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="6" data-title="Personalizar precios web">Personalizar precios web</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="7" data-title="Personalizar precios presenciales">Personalizar precios presenciales</a></li>
			</ol>

			<h2>Funcionalidades para entrenadores</h2>
			<h3>Entrenamientos</h3>
			<ol class="">
				<li><a href="#">Crea tus propios entrenamientos</a></li>
				<li><a href="#">Crear tu propia base de ejercicios con fotos  video y explicación teórica de estos</a></li>
				<li><a href="#">Crear un entrenamiento a un cliente</a></li>
				<li><a href="#">Crear un entrenamiento mientras das una clase presencial utilizando foto de inicio y fin de ejercicio con la imagen del propio cliente realizando el ejercicio</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="11" data-title="Localiza un entrenamiento o grupo de estos utilizando sistema de filtros">Localiza un entrenamiento o grupo de estos utilizando sistema de filtros</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="13" data-title="Cómo clonar entrenamientos asignados a ciertos clientes y personalizarlos para ser asignados a otros con necesidades/posibilidades/objetivos parecidos">Cómo clonar entrenamientos asignados a ciertos clientes y personalizarlos para ser asignados a otros con necesidades/posibilidades/objetivos parecidos</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="14" data-title="Acceder a base de datos de los entrenamientos asignados a todos tus clientes">Acceder a base de datos de los entrenamientos asignados a todos tus clientes</a></li>
				<li><a href="#">Utilizar ejercicios predeterminados de forma gratuita pendiente</a></li>
				<li><a href="#">Cómo modificar los ejercicios  predeterminados y darles tu punto personal</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="17" data-title="Acceder a base de datos de los entrenamientos asignados a todos tus clientes">Cómo hacer que se guarde directamente en tu galería de plantillas un nuevo entrenamiento creado para un cliente</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="18" data-title="Cómo asignar un entrenamiento ya creado para otro cliente">Cómo asignar un entrenamiento ya creado para otro cliente</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="19" data-title="Cómo previsualizar un entrenamiento de tu galería antes de asignarselo a un cliente">Cómo previsualizar un entrenamiento de tu galería antes de asignarselo a un cliente</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="20" data-title="Cómo borrar, ocultar o editar un entrenamiento ya creado">Cómo borrar, ocultar o editar un entrenamiento ya creado</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="21" data-title="Cómo crear, eliminar o modificar tus categorías de grupos musculares">Cómo crear, eliminar o modificar tus categorías de grupos musculares</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="22" data-title="Crear tus propios ejercicios con tus fotos de inicio y fin de ejercicio, videos explicativos y textos informativos">Crear tus propios ejercicios con tus fotos de inicio y fin de ejercicio, videos explicativos y textos informativos</a></li>
			</ol>

			<h3>Dietas</h3>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="23" data-title="Cómo crear una dieta de cero a un cliente">Cómo crear una dieta de cero a un cliente</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="24" data-title="Crear una dieta utilizando una plantilla de las que tu mismo hayas generado">Crear una dieta utilizando una plantilla de las que tu mismo hayas generado</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="25" data-title="Cómo añadir, editar o borrar una categoría de alimentos">Cómo añadir, editar o borrar una categoría de alimentos</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="26" data-title="Cómo añadir, editar o borrar alimentos">Cómo añadir, editar o borrar alimentos</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="27" data-title="Modificar o borrar alimentos de la lista de alimentos predefinidos">Modificar o borrar alimentos de la lista de alimentos predefinidos</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="28" data-title="Añadir o borrar restricciones alimenticias">Añadir o borrar restricciones alimenticias</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="29" data-title="Añadir o borrar objetivos dieteticos">Añadir o borrar objetivos dieteticos</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="30" data-title="Cómo localizar un tipo de dieta (definición, volumen, mantenimiento etc etc)">Cómo localizar un tipo de dieta (definición, volumen, mantenimiento etc etc)</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="31" data-title="Cómo asignar una antigua dieta a otro socio con unas pequeñas modificaciones">Cómo asignar una antigua dieta a otro socio con unas pequeñas modificaciones</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="32" data-title="Cómo Generar plantillas de dietas de 0">Cómo Generar plantillas de dietas de 0</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="33" data-title="Cómo editar, borrar, ocultar (Tu cliente no podra verla) o cerrar una dieta de tu cliente">Cómo editar, borrar, ocultar (Tu cliente no podra verla) o cerrar una dieta de tu cliente</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="34" data-title="Cómo previsualizar una dieta de tu galería antes de reasignarla a otro cliente">Cómo previsualizar una dieta de tu galería antes de reasignarla a otro cliente</a></li>
			</ol>

			<h3>Zona de evolución</h2>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="35" data-title="Cómo colocar la imagen q encabeza la zona de peso y medidas corporales">Cómo colocar la imagen q encabeza la zona de peso y medidas corporales</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="36" data-title="Cómo colocar la imagen q encabeza la zona de pruebas físicas">Cómo colocar la imagen q encabeza la zona de pruebas físicas</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="37" data-title="Cómo añadir texto al cabecero de las pruebas físicas">Cómo añadir texto al cabecero de las pruebas físicas</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="38" data-title="Cómo editar las medidas q quieras tomar a tus clientes y su unidad de medida">Cómo editar las medidas q quieras tomar a tus clientes y su unidad de medida</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="39" data-title="Cómo editar las pruebas físicas q quieras preparar a tus clientes y su unidad de medida">Cómo editar las pruebas físicas q quieras preparar a tus clientes y su unidad de medida</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="40" data-title="Acceder a zonas de observación de prueba fisica, peso, medidas corporales">Acceder a zonas de observación de prueba fisica, peso, medidas corporales</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="41" data-title="Cómo colocar las fotos de evolución de tus clientes">Cómo colocar las fotos de evolución de tus clientes</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="42" data-title="Cómo utilizar los puntos de control de las gráficas">Cómo utilizar los puntos de control de las gráficas</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="43" data-title="Cómo utilizar la funcionalidad de comentarios personales de las zonas de seguimiento del cliente">Cómo utilizar la funcionalidad de comentarios personales de las zonas de seguimiento del cliente</a></li>
			</ol>


			<h3>Filtro de clientes</h3>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="44" data-title="">Cómo utilizar el formulario de tus clientes para filtralos según tus necesidades</a></li>
			</ol>

			<h3>Alta o baja de socios</h3>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="45" data-title="">Cómo dar de alta o baja a un socio</a></li>
			</ol>

			<h3>Alarmas hacia el entrenador y su cliente</h3>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="46" data-title="">Como personalizar tus alertas como entrenador para llegado la fecha ser avisado automáticamente</a></li>
			</ol>
			

				
			<h2>Zonas a cumplimentar por tu cliente</h2>
			<p>5 formularios serán cumplimentados por tu cliente de forma obligatoria. Una vez se de de alta en tu espacio web, los 5 formularios aparecerán uno detrás de otro y una vez hecho de forma correcta, solo tu como entrenador y tu propio cliente tendréis acceso a ellos</p>
			<ol class="">
				 <li>Formulario personal zona fotos</li>
				 <li>Formulario personal datos personales</li>                    
				 <li>Formulario de gustos dieteticos</li>
				 <li>Formulario de hábitos dieteticos</li>    
				 <li>Formulario de peso y medidas corporales</li>
			</ol>
			<p><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="47" data-title="Zonas a cumplimentar por tu cliente">Ver vídeo</a></p>

			<h2>En estos 3 puntos, seras tú como entrenador quien personalice las pruebas físicas que veas oportunas</h2>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="48" data-title="Formulario de pruebas físicas de fuerza">Formulario de pruebas físicas de fuerza</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="49" data-title="Formulario de pruebas de velocidad">Formulario de pruebas de velocidad</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="50" data-title="Formulario de pruebas de distancia">Formulario de pruebas de distancia</a></li>
			</ol>

			<h2>Funcionalidades hacia tu cliente</h2>
			<ol class="">
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="51" data-title="Acceso a dietas personalizadas y a entrenamientos personalizados">Acceso a dietas personalizadas y a entrenamientos personalizados</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="52" data-title="Funcionalidades explicativas de los entrenamientos (fotos y video de ejercicios)">Funcionalidades explicativas de los entrenamientos (fotos y video de ejercicios)</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="52" data-title="Funcionalidad del blog de notas de los entrenamientos. Como anotar y borrar anotaciones">Funcionalidad del blog de notas de los entrenamientos. Como anotar y borrar anotaciones</a></li>
				<li><a href="#" data-toggle="modal" data-target="#help-video-modal" data-video-id="54" data-title="Como accederá tu cliente a sus 3 fotos de evolución fisica, a sus marcas evolutivas en las diferentes pruebas físicas y medidas corporales">Como accederá tu cliente a sus 3 fotos de evolución fisica, a sus marcas evolutivas en las diferentes pruebas físicas y medidas corporales</a></li>
			</ol>

		</div>
	</div>
</div>
<div class="modal fade" id="help-video-modal" tabindex="-1" role="dialog" aria-labelledby="help-video-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="help-video-modal-label">Vídeo</h4>
      </div>
      <div class="modal-body">
		<div class="video-layer-y">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
(function($){
$('#help-video-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var videoId = button.data('video-id');
  var title = button.data('title');
  var modal = $(this);
  var videos = {
	'1' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/kIbntEmItq0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'2' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/DBrrnJTYVcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'3' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/Uoyj2exPtZE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'4' : '<iframe width="560" height="315" class="elite-h-video" src="https://www.youtube.com/embed/FJfqmFfdC-Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'5' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/NSJWqY4bXr4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'6' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/0uGQyEE8Bv4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'7' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/T_zH-d39KaU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',

	'11' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/5XUseGluPow" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',

	'13' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/249SJlLnVeM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'14' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/4aTlbtt9dBM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'17' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/AHSTE9CR4so" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'18' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/NqEqcLyJGoY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'19' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/P8RdcWO2uR4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'20' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/k570gtLExBY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'21' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/99T6uhXRBg0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'22' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/y2DqT5Tyggc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'23' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/OALJ_neI6Qc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'24' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/kdBOwXIGPeE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'25' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/1Z7ijkbrAwM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'26' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/8lsf51d6yIY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'27' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/GJn6xtJd2k0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'28' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/qwB2GrLWPLo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'29' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/ewe2JFNS3dM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'30' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/GggyloeRpeA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'31' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/Vv8EK2_4_0c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'32' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/Krted_b0EK0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'33' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/0p9D42GfHE0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'34' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/wSFpYa_dLfc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'35' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/c1wYFFnlTEs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'36' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/zjzijjQwoMY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'37' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/N4_6aXaTAXg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'38' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/YuDMwG7VCtU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'39' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/_MrEfikTXpk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'40' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/rZnKf4tHzMg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'41' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/IWwxd61BSyA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'42' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/23AUbNfp6TA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'43' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/L6qiusk7PWs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'44' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/KRMePnxf0Qk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'45' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/O1W9KWvBPFQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'46' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/Cg17mp6BkUk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'47' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/wM01kLpmWxI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'48' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/Jwbl385Uaf0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'49' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/eck_JEbO3zs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'50' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/Dru8jIDGcJg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'51' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/xLd8vhzOzkg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'52' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/tFTnQ7BEZkk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'53' : '<iframe width="444" height="789" src="https://www.youtube.com/embed/tGhmWGGrU-I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
	'54' : '<iframe width="560" height="315" src="https://www.youtube.com/embed/j9EsYx5851M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
  };
  var xx = videos[videoId];
  modal.find('.modal-title').text(title);
  modal.find('.modal-body .video-layer-y').html(xx);
});
})(jQuery);
</script>
<?php get_footer('noclose'); ?>
