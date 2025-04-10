<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group iban-form-group">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
	<?php if( !$this->get_country() || $this->is_single_field() ) : ?>
		<input
			type="text"
			value="<?php echo esc_attr( $this->get_value() ); ?>"
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'form-control' ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			<?php if( $this->get_country() ) : ?>maxlength="<?php echo self::get_country_length( $this->get_country() ); ?>"<?php endif; ?>
			<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
			<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
			<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		/>
	<?php else : ?>
		<?php
			$iban_length = self::get_country_length( $this->get_country() );
			$fields_total = (int)($iban_length / 4);
		?>
		<?php for( $i = 0; $i < $fields_total; $i++ ) : ?>
			<input
				type="text"
				value="<?php if( is_string( $this->get_value() ) ) echo esc_attr( substr( $this->get_value(), $i * 4, 4 ) ); ?>"
				class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'form-control iban-subfield-form-control' ); ?>"
				id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>_<?php echo $i; ?>"
				name="<?php echo esc_attr( $this->get_name() ); ?>[<?php echo $i; ?>]"
				size="4"
				maxlength="4"
				<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
				<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
				<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
				<?php foreach( $this->get_attributes() as $key => $value ) : ?>
					<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php endforeach; ?>
			/>
		<?php endfor; ?>
		<?php if( $iban_length % 4 ) : ?>
			<input
				type="text"
				value="<?php if( is_string( $this->get_value() ) ) echo esc_attr( substr( $this->get_value(), $i * 4 ) ); ?>"
				class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'form-control iban-subfield-form-control' ); ?>"
				id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>_<?php echo $i; ?>"
				name="<?php echo esc_attr( $this->get_name() ); ?>[<?php echo $i; ?>]"
				size="<?php echo $iban_length % 4; ?>"
				maxlength="<?php echo $iban_length % 4; ?>"
				<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
				<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
				<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
				<?php foreach( $this->get_attributes() as $key => $value ) : ?>
					<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php endforeach; ?>
			/>
		<?php endif; ?>
	<?php endif; ?>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
