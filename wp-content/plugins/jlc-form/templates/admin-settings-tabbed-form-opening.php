<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<form
	method="<?php echo !empty( $this->method ) ? $this->method : 'POST'; ?>"
	action="<?php echo $this->get_form_action(); ?>"
	<?php if( !empty( $this->enctype ) ) : ?>enctype="<?php echo $this->enctype; ?>"<?php endif; ?>
	<?php if( !empty( $this->id ) ) : ?>id="<?php echo $this->id; ?>"<?php endif; ?>
	class="jlc-custom-form <?php if( $this->ajax && $this->wordpress_method ) : ?>jlc-custom-ajax-form<?php endif; ?> <?php if( !empty( $this->class ) ) : ?><?php echo esc_attr( $this->class ); ?><?php endif; ?>"
	<?php foreach( $this->get_attributes() as $key => $value ) : ?>
		<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
	<?php endforeach; ?>
>
	<?php wp_nonce_field( $this->get_nonce_action() ); ?>
	<input
		type="hidden"
		name="jlc_custom_form"
		value="<?php echo $this->internal_id; ?>"
	/>
<?php if( $this->wordpress_method ) : ?>
	<input type="hidden" name="action" value="<?php echo $this->action; ?>" />
	<?php if( $this->return_url_changed || !empty( $this->return_url ) ) : ?>
		<input type="hidden" name="return_url" value="<?php echo $this->return_url; ?>" />
	<?php endif; ?>
<?php endif; ?>
