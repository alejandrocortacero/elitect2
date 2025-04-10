<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="form-group form-group-table">
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>
	<?php if( !empty( $this->get_rows() ) ) : ?>
	<table class="jlc-custom-form-table-field table <?php echo esc_attr( $this->get_class() ); ?>">
	<?php if( is_array( $this->get_col_labels() ) ) : ?>
		<thead><tr>
		<?php foreach( $this->get_col_labels() as $key => $label ) : ?>
			<th class="th-<?php echo esc_attr( $key ); ?>">
				<?php echo esc_html( $label ); ?>
			</th>
		<?php endforeach; ?>
		</tr></thead>
	<?php endif; ?>
		<tbody>
		<?php foreach( $this->get_rows() as $rk => $row ) : ?>
			<tr class="tr-<?php echo esc_attr( $rk ); ?>">
			<?php foreach( $row as $ck => $field ) : ?>
				<td class="td-<?php echo esc_attr( $ck ); ?>">
					<?php $field->print_public( false ); ?>
				</td>
			<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
