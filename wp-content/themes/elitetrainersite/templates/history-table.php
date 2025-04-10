<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="history-table table-responsive">
	<h3>Seleccione una configuración previa</h3>
	<table class="table table-striped table-hover"><tbody>
	<?php foreach( $values as $date => $value ) : ?>
		<tr class="history-row"
		<?php foreach( $value as $key => $val ) : ?>
			data-<?php echo $key; ?>="<?php echo $val; ?>"
		<?php endforeach; ?>
		>
			<td><?php echo $date; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody></table>
</div>
