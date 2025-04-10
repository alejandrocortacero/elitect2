<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<p class="jlc-product-attachment text-center"><a class="btn btn-primary" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>"><?php echo esc_html( __( 'Download catalog', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></a></p>
