<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<button
	type="submit"
	class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
	id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	name="<?php echo esc_attr( $this->get_name() ); ?>"
><span><?php echo esc_html( $this->get_label() ); ?></span></button>
