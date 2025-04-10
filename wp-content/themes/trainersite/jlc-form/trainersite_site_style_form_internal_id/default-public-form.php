<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="row">
	<div class="col-xs-12">
		<?php $this->logo_heading->print_public(); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 logos-col">
		<div class="big-logo-layer layer">
			<?php $this->big_logo_image->print_public(); ?>
		</div>
		<div class="small-logo-layer layer">
			<?php $this->small_logo_image->print_public(); ?>
		</div>
		<div class="big-logo-field-layer layer">
			<?php $this->get_field_by_name( 'big_logo' )->print_public(); ?>
		</div>
		<div class="small-logo-field-layer layer">
			<?php $this->get_field_by_name( 'small_logo' )->print_public(); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<?php $this->colors_heading->print_public(); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-2 col-sm-offset-1">
		<?php $this->get_field_by_name( 'main_color' )->print_public(); ?>
	</div>
	<div class="col-xs-12 col-sm-2">
		<?php $this->get_field_by_name( 'secondary_color' )->print_public(); ?>
	</div>
	<div class="col-xs-12 col-sm-2">
		<?php $this->get_field_by_name( 'background_color' )->print_public(); ?>
	</div>
	<div class="col-xs-12 col-sm-2">
		<?php $this->get_field_by_name( 'text_color' )->print_public(); ?>
	</div>
	<div class="col-xs-12 col-sm-2">
		<?php $this->get_field_by_name( 'heading_color' )->print_public(); ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 text-center">
		<br />
		<?php $this->get_field_by_name( 'send' )->print_public(); ?>
	</div>
</div>
