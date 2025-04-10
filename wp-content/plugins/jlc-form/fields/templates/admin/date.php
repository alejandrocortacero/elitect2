<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php $datalist = $this->get_datalist(); ?>
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
		<input
			type="<?php echo esc_attr( $this->get_type() ); ?>"
			value="<?php echo esc_attr( $this->get_value() ); ?>"
			class="<?php echo esc_attr( !empty( $this->get_class() ) ? $this->get_class() : 'regular-text' ); ?>"
			id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
			name="<?php echo esc_attr( $this->get_name() ); ?>"
			<?php if( !empty( $this->get_placeholder() ) ) : ?>placeholder="<?php echo esc_attr( $this->get_placeholder() ); ?>"<?php endif; ?>
			<?php if( !empty( $this->get_max() ) ) :?>max="<?php echo $this->get_max(); ?>"<?php endif; ?>
			<?php if( !empty( $this->get_min() ) ) :?>min="<?php echo $this->get_min(); ?>"<?php endif; ?>
			<?php if( !empty( $this->get_step() ) ) :?>step="<?php echo $this->get_step(); ?>"<?php endif; ?>
			<?php if( $this->is_readonly() ) : ?>readonly="readonly"<?php endif; ?>
			<?php if( $this->is_required() ) : ?>required="required"<?php endif; ?>
			<?php if( $this->is_disabled() ) : ?>disabled="disabled"<?php endif; ?>
			<?php foreach( $this->get_attributes() as $key => $value ) : ?>
				<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
			<?php endforeach; ?>
			<?php if( !empty( $datalist ) ) : ?>list="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>-list"<?php endif; ?>
		/>
		<?php if( !empty( $this->get_help() ) ) : ?>
			<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
		<?php endif; ?>
		<?php if( !empty( $datalist ) ) : ?>
			<datalist id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>-list">
			<?php foreach( $datalist as $datalist_item ) : ?>
				<option value="<?php echo esc_attr( $datalist_item ); ?>" />
			<?php endforeach; ?>
			</datalist>
		<?php endif; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>
