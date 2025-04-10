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
		<textarea
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : '' ); ?> jlc-custom-form-tinymce"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
			<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
			<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
		><?php echo $this->get_value(); ?></textarea>
		<?php if( !empty( $this->get_help() ) ) : ?>
			<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
		<?php endif; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>

