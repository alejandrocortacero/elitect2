<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
	<div class="jlc-custom-form-upload-private-image-wrapper">
		<div
			class="jlc-custom-form-upload-private-image-preview"
			data-blank="<?php echo $this->get_blank_image_src(); ?>"
		>
			<img
				alt="<?php echo esc_attr( __( 'Selected image', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
				src="<?php echo $this->get_preview_image_src(); ?>"
			/>
		</div>
		<input
			type="file"
			accept="image/*"
			value=""
			data-has-value="<?php echo !empty( $this->get_value() ) && is_readable( $this->get_value() ) ? 'true' : 'false'; ?>"
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
			<?php if( $this->is_required() && ( empty( $this->get_value() ) || !is_readable( $this->get_value() ) ) ) : ?>required="required"<?php endif; ?>
			<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		/>
	</div>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
