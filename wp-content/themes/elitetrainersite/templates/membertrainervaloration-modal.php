<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="member-trainer-valoration-modal" tabindex="-1" role="dialog" aria-labelledby="member-trainer-valoration-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="member-trainer-valoration-modal-label">Valora a tu entrenador</h4>
      </div>
      <div class="modal-body">
		<?php echo EpointPersonalTrainerPublic::get_trainer_valoration_form(); ?>
      </div>
    </div>
  </div>
</div>



