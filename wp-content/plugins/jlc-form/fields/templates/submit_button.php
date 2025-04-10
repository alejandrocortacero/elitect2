<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<button
	type="submit"
	class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'btn btn-primary' ); ?>"
	id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	name="<?php echo esc_attr( $this->get_name() ); ?>"
	<?php if( $this->required ) : ?>required="required"<?php endif; ?>
	<?php if( $this->disabled ) : ?>disabled="disabled"<?php endif; ?>
	<?php foreach( $this->get_attributes() as $key => $value ) : ?>
		<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
	<?php endforeach; ?>
><?php echo wp_kses_post( $this->get_label() ); ?></button>
