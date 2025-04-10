<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div
	class="form-group jlc-custom-form-checkbox-group form-group-<?php echo esc_attr( $this->get_name() ); ?> <?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>" 
	id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
>
<label><?php echo esc_html( $this->get_label() ); ?></label>
<?php foreach( $this->get_options() as $option ) : ?>	
	<?php $option->print_public(); ?>
<?php endforeach; ?>
</div>
