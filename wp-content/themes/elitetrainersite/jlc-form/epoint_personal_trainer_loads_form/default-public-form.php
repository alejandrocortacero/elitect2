<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); 
$loads_field = $this->get_field_by_name( 'loads' );
?>
<?php foreach( $this->get_hidden_fields() as $field ) : ?>
	<?php $field->print_public(); ?>
<?php endforeach; ?>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon" onclick="jQuery(event.currentTarget).closest('form').submit();">
		<span class="glyphicon glyphicon-floppy-disk send"></span>
		<span class="glyphicon glyphicon-floppy-remove error"></span>
		<span class="glyphicon glyphicon-floppy-saved success"></span>
	</span>
    <input type="text" name="loads" class="form-control" value="<?php echo esc_attr( $loads_field->get_value() ); ?>"  />
  </div>
	<p class="help success-msg">¡Guardado!</p>
</div>
