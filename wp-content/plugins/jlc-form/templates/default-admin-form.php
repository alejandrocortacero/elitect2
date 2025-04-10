<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php foreach( $this->fields as $key => $field ) : ?>
	<?php $field->print_admin(); ?>
<?php endforeach; ?>
