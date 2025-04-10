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
		<?php foreach( $this->get_options() as $option ) : ?>	
			<?php $option->print_admin(); ?>
		<?php endforeach; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>
