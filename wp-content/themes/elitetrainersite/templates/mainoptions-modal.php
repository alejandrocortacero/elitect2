<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="main-options-modal" tabindex="-1" role="dialog" aria-labelledby="main-options-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="main-options-modal-label">Opciones generales</h4>
      </div>
      <div class="modal-body">
		<?php $form = EliteTrainerSiteTheme::get_main_options_form(); ?>
		<?php $form->print_public_form(); ?>
      </div>
    </div>
  </div>
</div>

