<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="home-cover-bg-modal" tabindex="-1" role="dialog" aria-labelledby="home-cover-bg-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="home-cover-bg-modal-label">Fondo de portada</h4>
      </div>
      <div class="modal-body">
		<?php $form = EliteTrainerSiteTheme::get_home_cover_bg_form(); ?>
		<?php $form->print_public_form(); ?>
      </div>
    </div>
  </div>
</div>
