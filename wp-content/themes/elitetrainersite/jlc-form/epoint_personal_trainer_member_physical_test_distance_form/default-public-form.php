<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); 
?>
<?php foreach( $this->get_hidden_fields() as $field ) : ?>
	<?php $field->print_public(); ?>
<?php endforeach; ?>
<div class="row">
	<div class="col-xs-12">
		<?php $this->get_field_by_name( 'when' )->print_public(); ?>
	</div>
</div>
<div class="row">
	<?php foreach( $this->get_magnitudes() as $magnitude ) : ?>
		<?php if( ( $field = $this->get_magnitude_field( $magnitude ) ) ) : ?>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<?php $field->print_public(); ?>
				<?php if( ( $graphic = $this->get_graphic( $magnitude ) ) ) : ?>
					<?php $graphic->print_public(); ?>
				<?php endif; ?>
				<?php if( ( $obs_field = $this->get_observations_field( $magnitude ) ) ) : ?>
					<?php $obs_field->print_public(); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<div class="row">
	<div class="col-xs-12">
		<br />
		<?php $this->get_field_by_name( 'send' )->print_public(); ?>
	</div>
</div>
