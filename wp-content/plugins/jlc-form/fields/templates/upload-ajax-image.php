<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="jlc-custom-form-upload-ajax-image-field <?php if( !empty( $this->get_value() ) ) : ?>set<?php endif; ?>">
	<label><?php echo esc_html( $this->get_label() ); ?></label>
	<div class="jlc-custom-form-upload-ajax-image-field-preview">
		<img
			alt="<?php echo esc_attr( __( 'Selected image', JLCCustomForm::TEXT_DOMAIN ) ); ?>"
			src="<?php echo $this->get_selector_image_url(); ?>"
			class="jlc-custom-form-upload-ajax-image-field-img"
		/>
		<div
			class="buttons"
			data-field="#<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>" 
			data-image="#<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>_img"
			data-control="#<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>_control"
		>
			<button class="jlc-custom-form-add-image"><span class="glyphicon glyphicon-plus"></span></button>
			<button class="jlc-custom-form-change-image"><span class="glyphicon glyphicon-pencil"></span></button>
			<?php if( $this->has_selection_window() ) : ?><button class="jlc-custom-form-select-image"><span class="glyphicon glyphicon-cloud-download"></span></button><?php endif; ?>
			<button class="jlc-custom-form-remove-image"><span class="glyphicon glyphicon-trash"></span></button>
			<div class="wait"><span class="glyphicon glyphicon-hourglass"></span></div>
		</div>
	</div>

	<input type="file" />
	<input
		type="hidden"
		value="<?php echo esc_attr( $this->get_value() ); ?>"
		data-default-image="<?php echo esc_attr( $this->get_value() ); ?>"
		class="jlc-custom-form-upload-ajax-img-id <?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
		id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		name="<?php echo esc_attr( $this->get_name() ); ?>"
		<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
		<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
		<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
		<?php foreach( $this->get_attributes() as $key => $value ) : ?>
			<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php endforeach; ?>
	/>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
