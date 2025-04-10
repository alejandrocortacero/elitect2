<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="col-xs-12 col-sm-6 photo">
	<?php if( false ) : ?>
	<img class="img-responsive" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $c->ID ) ); ?>" alt="photo" />
	<?php else : ?>
		<div class="real-case-photo real-case-photo-before" data-photo-id="<?php echo esc_attr( EpointRealCases::get_before_photo( $c->ID ) ); ?>" style="background-image:url('<?php echo wp_get_attachment_url( EpointRealCases::get_before_photo( $c->ID ) ); ?>');" data-photo-url="<?php echo wp_get_attachment_url( EpointRealCases::get_before_photo( $c->ID ) ); ?>"></div>
		<div class="real-case-photo real-case-photo-after" data-photo-id="<?php echo EpointRealCases::get_after_photo( $c->ID ); ?>" style="background-image:url('<?php echo wp_get_attachment_url( EpointRealCases::get_after_photo( $c->ID ) ); ?>');"  data-photo-url="<?php echo wp_get_attachment_url( EpointRealCases::get_after_photo( $c->ID ) ); ?>"></div>
	<?php endif; ?>
</div>
