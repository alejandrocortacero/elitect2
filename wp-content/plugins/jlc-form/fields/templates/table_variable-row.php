<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<tr class="fields-tr tr-{{rk}}" data-row="{{rk}}">
<?php foreach( $this->get_cols() as $col ) : ?>
	<td class="td-<?php echo esc_attr( !empty( $col['name'] ) ? $col['name'] : '{{ck}}' ); ?>">
		<?php $blank_field = $this->get_blank_field( $col ); ?>
		<?php if( $blank_field ) $blank_field->print_public(); ?>
	</td>
<?php endforeach; ?>
	<td class="remove-td">
		<button class="jlc-custom-form-table-variable-field-remove-row-button btn btn-danger" title="<?php echo esc_attr( $this->get_add_row_text() ); ?>"><span class="glyphicon glyphicon-remove"></span></button>
	</td>
</tr>
