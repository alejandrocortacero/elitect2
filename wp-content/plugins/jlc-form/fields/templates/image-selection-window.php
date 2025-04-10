<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="jlc-custom-form-upload-ajax-image-selection-window" tabindex="-1" role="dialog" aria-labelledby="jlc-custom-form-upload-ajax-image-selection-window-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="jlc-custom-form-upload-ajax-image-selection-window-label"><?php echo esc_html( __( 'Select image', JLCCustomForm::TEXT_DOMAIN ) ); ?></h4>
      </div>
      <div class="modal-body">
		<div class="images-layer">
		</div>
      </div>
	  <div class="modal-footer">
		<button class="btn btn-primary select-image"><?php echo esc_html( __( 'Select image', JLCCustomForm::TEXT_DOMAIN ) ); ?></button>
	  </div>
    </div>
  </div>
</div>

