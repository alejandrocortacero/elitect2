<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div
	class="form-group form-group-table-variable jlc-custom-form-table-variable-field-wrapper jlc-custom-form-table-variable-field-wrapper-<?php echo esc_attr( $this->get_format() ); ?>"
	data-field-id="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	data-form-id="<?php echo esc_attr( $form_id ); ?>"
>
	<?php if( !empty( $this->get_label() ) ) : ?>
	<label
		for="<?php echo esc_attr( !empty( $this->get_id() ) ? $this->get_id() : $this->get_name() ); ?>"
	>
		<?php echo esc_html( $this->get_label() ); ?>
	</label>
	<?php endif; ?>

	<div class="jlc-custom-form-table-variable-field-add-row-wrapper jlc-custom-form-table-variable-field-add-row-wrapper-top">
		<button class="jlc-custom-form-table-variable-field-add-row-button btn btn-default"><?php echo esc_html( $this->get_add_row_text() ); ?></button>
	</div>

	<?php if( $this->get_format() === 'sheet' ) : ?>
		<div class="jlc-custom-form-table-variable-field jlc-custom-form-table-variable-field-sheet <?php echo esc_attr( $this->get_class() ); ?>">
		<?php if( is_array( $this->get_col_labels() ) ) : ?>
			<div class="sheet-thead"><div class="sheet-tr">
			<?php foreach( $this->get_col_labels() as $key => $label ) : ?>
				<div class="sheet-th th-<?php echo esc_attr( $key ); ?>">
					<span class="sheet-th-text"><?php echo esc_html( $label ); ?></span>
				</div>
			<?php endforeach; ?>
				<div class="sheet-th remove-th"></div>
			</div></div>
		<?php endif; ?>
			<div class="sheet-tbody field-tbody">
			<?php foreach( $this->get_rows() as $rk => $row ) : ?>
				<div class="fields-tr sheet-tr tr-<?php echo esc_attr( $rk ); ?>" data-row="<?php echo esc_attr( $rk ); ?>">
				<?php foreach( $row as $ck => $field ) : ?>
					<div class="sheet-td td-<?php echo esc_attr( $ck ); ?>">
						<?php $field->print_public(); ?>
					</div>
				<?php endforeach; ?>
					<div class="sheet-td remove-td">
						<button class="jlc-custom-form-table-variable-field-remove-row-button btn btn-danger" title="<?php echo esc_attr( $this->get_add_row_text() ); ?>"><span class="glyphicon glyphicon-remove"></span></button>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	<?php else : ?>
		<table class="jlc-custom-form-table-variable-field <?php echo esc_attr( $this->get_class() ); ?>">
		<?php if( is_array( $this->get_col_labels() ) ) : ?>
			<thead><tr>
			<?php foreach( $this->get_col_labels() as $key => $label ) : ?>
				<th class="th-<?php echo esc_attr( $key ); ?>">
					<?php echo esc_html( $label ); ?>
				</th>
			<?php endforeach; ?>
			</tr></thead>
		<?php endif; ?>
			<tbody class="field-tbody">
			<?php foreach( $this->get_rows() as $rk => $row ) : ?>
				<tr class="fields-tr tr-<?php echo esc_attr( $rk ); ?>" data-row="{{rk}}">
				<?php foreach( $row as $ck => $field ) : ?>
					<td class="td-<?php echo esc_attr( $ck ); ?>">
						<?php $field->print_public(); ?>
					</td>
				<?php endforeach; ?>
					<td class="remove-td">
						<button class="jlc-custom-form-table-variable-field-remove-row-button btn btn-danger" title="<?php echo esc_attr( $this->get_add_row_text() ); ?>"><span class="glyphicon glyphicon-remove"></span></button>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<div class="jlc-custom-form-table-variable-field-add-row-wrapper jlc-custom-form-table-variable-field-add-row-wrapper-bottom">
		<button class="jlc-custom-form-table-variable-field-add-row-button btn btn-default"><?php echo esc_html( $this->get_add_row_text() ); ?></button>
	</div>

	<?php if( !empty( $this->get_help() ) ) : ?>
		<p class="description"><?php echo esc_html( $this->get_help() ); ?></p>
	<?php endif; ?>
</div>
