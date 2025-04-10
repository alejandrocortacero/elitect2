<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="home-cover-video-modal" tabindex="-1" role="dialog" aria-labelledby="home-cover-video-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="home-cover-video-modal-label">Vídeo de inicio</h4>
      </div>
      <div class="modal-body">
		<?php $form = EliteTrainerSiteTheme::get_home_cover_video_form(); ?>
		<?php $form->print_public_form(); ?>
      </div>
    </div>
  </div>
</div>
