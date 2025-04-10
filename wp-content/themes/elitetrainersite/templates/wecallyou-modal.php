<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="we-call-you-modal" tabindex="-1" role="dialog" aria-labelledby="we-call-you-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="we-call-you-modal-label">Info / Te llamamos</h4>
      </div>
      <div class="modal-body">
			<div class="row">
				<?php $phone = esc_attr( EliteTrainerSiteThemeCustomizer::get_contact_phone() ); ?>
				<div class="col-xs-6 text-center">
					<a class="tel-link" href="tel:<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/mobile_3d.png" alt="Mobile" class="contact-icon img-responsive" />
					</a> 
				</div>
				<div class="col-xs-6 text-center">
					<a class="whatsapp-link" href="https://api.whatsapp.com/send?phone=<?php echo preg_replace( '/\D/', '', $phone ); ?>" rel="nofollow">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/whatsapp_3d.png" alt="Whatsapp" class="contact-icon img-responsive" />
					</a> 
				</div>
			</div>
			<hr />
			<?php echo do_shortcode( '[jlc_we_call_you_form /]' ); ?>
      </div>
    </div>
  </div>
</div>

