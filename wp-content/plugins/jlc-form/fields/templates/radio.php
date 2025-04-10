<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="radio <?php if( $this->is_disabled() ) : ?>disabled<?php endif; ?>">
	<label>
		<input
			type="<?php echo esc_attr( $this->get_type() ); ?>"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
			value="<?php echo esc_attr( $this->get_value() ); ?>"
			<?php if( $this->is_checked() ) : ?>checked="checked"<?php endif; ?>
			<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
			<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
			<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		/>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
</div>

