<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="jlc-custom-form-audio-recorder-field">
	<input
		type="hidden"
		value="<?php echo esc_attr( $this->get_value() ); ?>"
		class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
		id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		name="<?php echo esc_attr( $this->get_name() ); ?>"
		<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
		<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
		<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
		<?php foreach( $this->get_attributes() as $key => $value ) : ?>
			<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php endforeach; ?>
	/>
</div>
