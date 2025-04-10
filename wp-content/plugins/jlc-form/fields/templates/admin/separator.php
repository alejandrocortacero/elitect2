<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( $wrapped ) : ?>
<tr>
	<th scope="row">
	</th>
	<td>
<?php else : ?>
<?php endif; ?>
		<hr 
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?>"
			<?php if( !empty( $this->get_id() ) ) : ?>
				id="<?php echo esc_attr( $this->get_id() ); ?>"
			<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		/>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>
