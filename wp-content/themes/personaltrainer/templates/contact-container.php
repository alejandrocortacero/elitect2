<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( false ) : ?>
<div class="container-fluid black-container">
	<div class="row">
		<div class="col-xxs-12 col-xs-12">
			<header><h2 class="text-center"><?php echo esc_html( __( 'Solve your doubts', EkonatureTheme::TEXT_DOMAIN ) ); ?></h2></header>
		</div>
	</div>
</div>
<?php get_template_part( 'templates/contact', 'containerbody' ); ?>
<?php endif; ?>
<div class="container contact-info-container">
	<div class="row">
		<div class="col-xs-12">
			<h2 class="text-center">¿Tienes alguna duda?</h2>
            <div style="display: flex; justify-content: center; align-items: center; gap: 20px; text-align: center;">
                <div class="col-xs-12 col-sm-4 text-center">
                    <?php ob_start(); ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/whatsapp_3d.png" alt="Whatsapp" class="contact-icon" />
                    <h3 class="text-center"><?php echo preg_replace( '/\(.*\)/', '', JLCContact::get_contact_whatsapp() ); ?></h3>
                    <?php $whatsapp_text = ob_get_clean(); ?>
                    <?php echo JLCContact::get_contact_whatsapp_link( $whatsapp_text ); ?>
                </div>
                <div class="col-xs-12 col-sm-4 text-center">
                    <?php ob_start(); ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/envelope_3d.png" alt="Mail" class="contact-icon" />
                    <h3 class="text-center"><?php echo JLCContact::get_contact_email(); ?></h3>
                    <?php $email_text = ob_get_clean(); ?>
                    <?php echo JLCContact::get_contact_email_link( $email_text ); ?>
                </div>
            </div>
	</div>
</div>
<div class="container-fluid contact-container">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2 contact-form-col">
				<?php if( class_exists( 'JLCContact' ) ) : ?>
					<?php echo JLCContact::get_contact_form(); ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
