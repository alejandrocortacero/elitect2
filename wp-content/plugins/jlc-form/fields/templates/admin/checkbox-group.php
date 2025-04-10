<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( $wrapped ) : ?>
<tr>	
	<th scope="row">
	<?php if( !empty( $this->get_label() ) ) : ?>
		<label><?php echo esc_html( $this->get_label() ); ?></label>
	<?php endif; ?>
	</th>
	<td>
<?php else : ?>
	<?php if( !empty( $this->get_label() ) ) : ?>
		<label><?php echo esc_html( $this->get_label() ); ?></label>
	<?php endif; ?>
<?php endif; ?>
	<div
		class="jlc-custom-form-checkbox-group <?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
		id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
		<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
	>
		<?php foreach( $this->get_options() as $option ) : ?>	
			<?php $option->print_admin(); ?>
		<?php endforeach; ?>
	</div>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>

