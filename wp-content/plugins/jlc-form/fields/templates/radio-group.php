<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group form-group-<?php echo esc_attr( $this->get_name() ); ?>">
<?php if( !empty( $this->get_label() ) ) : ?>
	<label><?php echo esc_html( $this->get_label() ); ?></label>
<?php endif; ?>
<?php foreach( $this->get_options() as $option ) : ?>	
	<?php $option->print_public(); ?>
<?php endforeach; ?>
</div>
