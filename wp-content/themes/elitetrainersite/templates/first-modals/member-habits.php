<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="member-habits-first-modal" tabindex="-1" role="dialog" aria-labelledby="member-habits-first-modal-label">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="member-habits-first-modal-label">Primeros pasos</h4>
      </div>
      <div class="modal-body">
			<p class="text-center">Ahora debes indicar tus hábitos alimentarios.</p>
			<p class="text-center"><button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Adelante">¡Adelante!</button></p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){
	$(document).ready(function(){
		$('#member-habits-first-modal').modal('show');
	});
})(jQuery);
</script>
