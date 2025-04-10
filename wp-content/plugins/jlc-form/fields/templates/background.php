<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group jlc-custom-form-background-field">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<div class="jlc-custom-form-background-preview">
		<div class="jlc-custom-form-background-preview-inner" style="background-image:<?php if( $this->get_background_type() == 'gradient' ) : ?>linear-gradient(to right,<?php echo esc_attr( $this->get_color( 0 ) ); ?> 0, <?php echo esc_attr( $this->get_color( 1 ) ); ?> 100%)<?php elseif( $this->get_background_type() == 'gradient_v' ) : ?>linear-gradient(to bottom,<?php echo esc_attr( $this->get_color( 0 ) ); ?> 0, <?php echo esc_attr( $this->get_color( 1 ) ); ?> 100%)<?php else : ?>none<?php endif; ?>; background-color:<?php echo esc_attr( $this->get_color( 0 ) ); ?>"></div>
	</div>
	<?php endif; ?>
	<select class="jlc-custom-form-background-select-type form-control" name="<?php echo esc_attr( $this->get_name() ); ?>[type]">
		<option value="solid" <?php if( $this->get_background_type() == 'solid' ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( __( 'Solid', JLCCustomForm::TEXT_DOMAIN ) ); ?></option>
		<option value="gradient" <?php if( $this->get_background_type() == 'gradient' ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( __( 'Gradient', JLCCustomForm::TEXT_DOMAIN ) ); ?></option>
		<option value="gradient_v" <?php if( $this->get_background_type() == 'gradient_v' ) : ?>selected="selected"<?php endif; ?>><?php echo esc_html( __( 'Vertical gradient', JLCCustomForm::TEXT_DOMAIN ) ); ?></option>
	</select>
	<div class="color-selectors">
		<div class="color-col">
			<input
				type="color"
				value="<?php echo esc_attr( $this->get_color( 0 ) ); ?>"
				class="jlc-custom-form-background-color-selector jlc-custom-form-background-color-0 <?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'form-control' ); ?>"
				id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>_color_0"
				name="<?php echo esc_attr( $this->get_name() ); ?>[color_0]"
				<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
				<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
				<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
				<?php foreach( $this->get_attributes() as $key => $value ) : ?>
					<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php endforeach; ?>
			/>
<?php if( false )  :?>
			<input class="jlc-custom-form-background-color-opacity-selector jlc-custom-form-background-color-0-opacity" type="number" min="0" max="1" step="0.01" name="<?php echo esc_attr( $this->get_name() ); ?>[color_0_opacity]" value="<?php echo esc_attr( $this->get_color_opacity( 0 ) ); ?>" />
<?php endif; ?>
			<?php $this->opacity_fields[0]->print_public(); ?>
		</div>
		<div class="color-col <?php if( $this->get_background_type() == 'solid' ) : ?>hidden-field<?php endif; ?>">
			<input
				type="color"
				value="<?php echo esc_attr( $this->get_color( 1 ) ); ?>"
				class="jlc-custom-form-background-color-selector jlc-custom-form-background-color-1 <?php if( $this->get_background_type() == 'solid' ) : ?>hidden-field<?php endif; ?> <?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'form-control' ); ?>"
				id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>_color_1"
				name="<?php echo esc_attr( $this->get_name() ); ?>[color_1]"
				<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
				<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
				<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
				<?php foreach( $this->get_attributes() as $key => $value ) : ?>
					<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php endforeach; ?>
			/>
			<?php if( false ) : ?>
			<input class="jlc-custom-form-background-color-opacity-selector jlc-custom-form-background-color-1-opacity" type="number" min="0" max="1" step="0.01" name="<?php echo esc_attr( $this->get_name() ); ?>[color_1_opacity]" value="<?php echo esc_attr( $this->get_color_opacity( 1 ) ); ?>" />
			<?php endif; ?>
			<?php $this->opacity_fields[1]->print_public(); ?>
		</div>
	</div>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
