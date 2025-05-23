<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="checkbox <?php if( $this->is_disabled() ) : ?>disabled<?php endif; ?>">
	<input
		type="<?php echo esc_attr( $this->get_type() ); ?>"
		name="<?php echo esc_attr( $this->get_name() ); ?>"
		id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?> input-checkbox cool"
		value="<?php echo esc_attr( $this->get_value() ); ?>"
		<?php if( $this->is_checked() ) : ?>checked="checked"<?php endif; ?>
		<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
		<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
		<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
		<?php foreach( $this->get_attributes() as $key => $value ) : ?>
			<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php endforeach; ?>
	/>
	<label for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>">
		<span class="checker"></span>
		<?php echo wp_kses_post( $this->get_label() ); ?>
	</label>
</div>
