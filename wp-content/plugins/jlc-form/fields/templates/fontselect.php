<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group">
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<select
		class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?> form-control <?php if( $this->get_ajax_callable() ) : ?>jlc-custom-ajax-field<?php endif; ?>"
		id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		name="<?php echo esc_attr( $this->get_name() ); ?><?php if( $this->is_multiple() ) : ?>[]<?php endif; ?>"
		<?php if( $this->is_multiple() ) : ?>multiple="multuple"<?php endif; ?>
		<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
		<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
		<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
		<?php foreach( $this->get_attributes() as $key => $value ) : ?>
			<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php endforeach; ?>
	>
	<?php foreach( $this->get_options() as $option ) : ?>
		<option
			value="<?php echo esc_attr( $option->get_value() ); ?>"
			style="font-family:'<?php echo esc_attr( $option->get_value() ); ?>';"
			<?php if( $option->is_selected() ) : ?>selected="selected"<?php endif; ?>
			<?php if( $option->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
		><?php echo esc_html( $option->get_label() ); ?></option>
	<?php endforeach; ?>
	</select>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
