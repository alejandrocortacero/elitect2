<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
	<?php wp_editor(
		$this->get_value(),
		$this->get_id() ? $this->get_id() : $this->get_name(),
		$this->editor_args
	); ?>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
