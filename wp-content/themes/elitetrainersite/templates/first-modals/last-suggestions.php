<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="personal-questionnaire-first-modal" tabindex="-1" role="dialog" aria-labelledby="personal-questionnaire-first-modal-label">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="personal-questionnaire-first-modal-label">Primeros pasos</h4>
      </div>
      <div class="modal-body">
			<h4 class="text-center">¡Gracias!</h4>	
			<p class="text-center">Tu perfil está terminado. Se ha notificado a tu entrenador que has terminado de rellenar todos los formularios.</p>
			<p class="text-center"><button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Adelante">Finalizar</button></p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){
	$(document).ready(function(){
		$('#personal-questionnaire-first-modal').modal('show');
	});
})(jQuery);
</script>
