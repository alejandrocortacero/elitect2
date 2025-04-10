<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
//add_filter( 'body_class', function( $classes ){ $classes[] = 'no-padding';return $classes; } );
?><?php
get_header('noopen');
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center">Super administrador</h1>
			<a href="<?php echo get_permalink( get_option( PersonalTrainerTheme::SUPERTRAINER_PAGE_EXERCISES_KEY ) ); ?>" class="btn btn-primary">Ejercicios</a>
			<a href="<?php echo get_permalink( get_option( PersonalTrainerTheme::SUPERTRAINER_PAGE_TRAINING_KEY ) ); ?>" class="btn btn-primary">Entrenamientos</a>
			<a href="#" class="btn btn-primary">Dietas</a>
			<a href="<?php echo get_permalink( get_option( PersonalTrainerTheme::SUPERTRAINER_PAGE_TRAINERS_KEY ) ); ?>" class="btn btn-primary">Entrenadores</a>
		</div>
	</div>
</div>
<?php get_footer('noclose'); ?>
