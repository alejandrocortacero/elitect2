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
		<div class="jlc-custom-form-jquery-slider"
			data-input="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			data-min="<?php echo esc_attr( $this->get_min() ); ?>"
			data-max="<?php echo esc_attr( $this->get_max() ); ?>"
			data-step="<?php echo esc_attr( $this->get_step() ); ?>"
			data-handle-quantity="yes"
		></div>
		<?php if( !empty( $this->get_help() ) ) : ?>
			<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
		<?php endif; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>

