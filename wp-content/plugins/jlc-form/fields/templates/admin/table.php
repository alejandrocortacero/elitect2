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
	<?php if( !empty( $this->get_rows() ) ) : ?>
	<div class="jlc-custom-form-table-field-wrapper jlc-custom-form-table-field-wrapper-<?php echo esc_attr( $this->format ); ?>">
		<?php if( $this->format === 'sheet' ) : ?>
			<div class="jlc-custom-form-table-field jlc-custom-form-table-field-sheet <?php echo esc_attr( $this->get_class() ); ?>">
			<?php if( is_array( $this->get_col_labels() ) ) : ?>
				<div class="sheet-thead"><div class="sheet-tr">
				<?php foreach( $this->get_col_labels() as $key => $label ) : ?>
					<div class="sheet-th th-<?php echo esc_attr( $key ); ?>">
						<span class="sheet-th-text"><?php echo esc_html( $label ); ?></span>
					</div>
				<?php endforeach; ?>
				</div></div>
			<?php endif; ?>
				<div class="sheet-tbody">
				<?php foreach( $this->get_rows() as $rk => $row ) : ?>
					<div class="sheet-tr tr-<?php echo esc_attr( $rk ); ?>">
					<?php foreach( $row as $ck => $field ) : ?>
						<div class="sheet-td td-<?php echo esc_attr( $ck ); ?>">
							<?php $field->print_admin( false ); ?>
						</div>
					<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		<?php else : ?>
			<table class="jlc-custom-form-table-field <?php echo esc_attr( $this->get_class() ); ?>">
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
							<?php $field->print_admin( false ); ?>
						</td>
					<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
<?php if( $wrapped ) : ?>
	</td>
</tr>
<?php endif; ?>
