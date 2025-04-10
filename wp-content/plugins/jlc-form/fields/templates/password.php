<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
	<div class="input-group">
		<input
			type="<?php echo esc_attr( $this->get_type() ); ?>"
			value="<?php echo esc_attr( $this->get_value() ); ?>"
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'form-control' ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			<?php if( !empty( $this->get_placeholder() ) ) : ?>placeholder="<?php echo esc_attr( $this->get_placeholder() ); ?>"<?php endif; ?>
			<?php if( is_integer( $this->get_maxlength() ) ) :?>maxlength="<?php echo $this->get_maxlength(); ?>"<?php endif; ?>
			<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
			<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
			<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		/>
		<span class="input-group-addon toggle-password-visibility"><span class="glyphicon glyphicon-eye-open"></span></span>
	</div>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
