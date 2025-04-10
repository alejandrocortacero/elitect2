<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php

//if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
if( !class_exists( 'EpointPersonalTrainer', false ) || !EpointPersonalTrainer::is_site_client() )
{
	wp_redirect( get_site_url() );
	exit;
}

add_filter( 'body_class', function( $classes ){ $classes[] = 'page-trainer-valoration'; return $classes; } );

get_header('noopen');
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center">Valora a tu entrenador</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 col-xs-12">
				<?php echo EpointPersonalTrainerPublic::get_trainer_valoration_form(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer('noclose'); ?>

