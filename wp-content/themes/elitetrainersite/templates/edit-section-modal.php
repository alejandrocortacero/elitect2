<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="<?php echo $modal['target']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal['target']; ?>-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="<?php echo $modal['target']; ?>-label"><?php echo esc_html( $modal['title'] ); ?></h4>
      </div>
      <div class="modal-body">
		<?php $form = EliteTrainerSiteTheme::get_form( $modal['form'] ); ?>
		<?php $form->print_public_form(); ?>
      </div>
    </div>
  </div>
</div>

