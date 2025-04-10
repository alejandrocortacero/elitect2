<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="trainer-help-modal" tabindex="-1" role="dialog" aria-labelledby="trainer-help-modal-label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="trainer-help-modal-label">Configura tu sitio</h4>
      </div>
      <div class="modal-body">
<div class="row">
	<div class="col-xs-12">
		<h3 class="text-center">¡Bienvenido!</h3>
		<p class="text-center">Antes de continuar, echa un vistazo a la página de ayuda y aprende como configurar tu sitio.</p>
		<p class="text-center"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_help_page_url(); ?>">Ver ayuda</a></p>
	</div>
</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){

$(document).ready(function(){
	setTimeout(function(){$('#trainer-help-modal').modal('show');},500);
});

})(jQuery);
</script>

