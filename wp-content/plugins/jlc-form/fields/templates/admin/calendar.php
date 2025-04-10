<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( $wrapped ) : ?>
<tr>
	<th scope="row">
		<?php if( !empty( $this->get_label() ) ) : ?>
		<label
			for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		>
			<?php echo esc_html( $this->get_label() ); ?>
		</label>
		<?php endif; ?>
	</th>
	<td>
<?php else : ?>
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
<?php endif; ?>
		<div class="jlc-custom-form-calendar-combo">
			<p class="error-required-field-message" style="display:none;"><?php echo esc_html( __( 'Select a date, please.', JLCCustomForm::TEXT_DOMAIN ) ); ?></p>
			<input
				type="hidden"
				value="<?php echo esc_attr( !empty( $this->get_value() ) ? json_encode( $this->get_value() ) : '' ); ?>"
				data-original="<?php echo esc_attr( !empty( $this->get_value() ) ? json_encode( $this->get_value() ) : '' ); ?>"
				class="jlc-calendar-value-field <?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'regular-text' ); ?>"
				id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
				name="<?php echo esc_attr( $this->get_name() ); ?>"
				<?php if( !empty( $this->get_placeholder() ) ) : ?>placeholder="<?php echo esc_attr( $this->get_placeholder() ); ?>"<?php endif; ?>
				<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
				<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
				<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
				<?php foreach( $this->get_attributes() as $key => $value ) : ?>
					<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php endforeach; ?>
			/>
			<?php if( class_exists( 'JLCCalendar', false ) ) : ?>
				<?php
					$calendar = new JLCCalendar( $this->get_calendar_args() );
					$calendar->print_calendar();
				?>
			<?php else : ?>
				<p><?php echo esc_html( __( 'This field requires JLCCalendar plugin.', JLCCustomForm::TEXT_DOMAIN ) ); ?></p>
			<?php endif; ?>
		</div>
		<?php if( !empty( $this->get_help() ) ) : ?>
			<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
		<?php endif; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>

