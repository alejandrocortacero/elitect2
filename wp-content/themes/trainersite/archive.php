<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php get_header(); ?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-9">
		<?php get_template_part( 'templates/posts', 'list' ); ?>
	</div>
	<div class="hidden-xs col-sm-4 col-md-3">
		<?php get_sidebar( 'blog' ); ?>
	</div>
</div>
<?php get_footer(); ?>
