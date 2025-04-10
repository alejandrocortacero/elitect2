<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
	<input
		type="hidden"
		value="<?php echo esc_attr( $this->get_value() ); ?>"
		class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?> jlc-custom-form-stars-input"
		id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		name="<?php echo esc_attr( $this->get_name() ); ?>"
		<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
		<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
		<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
		<?php foreach( $this->get_attributes() as $key => $value ) : ?>
			<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php endforeach; ?>
	/>
	<div class="jlc-custom-form-stars-control">
	<?php for( $i = 1; $i <= $this->get_stars(); $i++ ) : ?>
		<div class="star star-<?php echo $i; ?>" data-star="<?php echo $i; ?>">
			<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'img', 'star.svg' ) ) ); ?>
		</div>
	<?php endfor; ?>
	</div>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="help-block"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
