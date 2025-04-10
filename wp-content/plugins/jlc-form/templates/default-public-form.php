<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php foreach( $this->get_fields() as $field ) : ?>
	<?php $field->print_public(); ?>
<?php endforeach; ?>
