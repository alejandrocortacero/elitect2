<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="container-fluid home-contact-container contact-container square-mesh">
	<div class="container">
		<div class="row equal-height">
			<?php if( false ) : ?>
			<div class="col-xs-12 col-sm-6 contact-places-col">
				<?php get_template_part( 'templates/contact', 'places' ); ?>
			</div>
			<?php endif; ?>
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 contact-col">
				<div class="contact">
					<?php get_template_part( 'templates/contact', 'form' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
