<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<div class="ui-widget">
			<input type="hidden" name="post_type" value="post" />
			<input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="<?php echo esc_attr( __( 'Search &hellip;', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>" aria-label="<?php echo esc_attr( __( 'Search text', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</div>
	</div>
	<button type="submit" class="search-submit btn btn-default"><span class="glyphicon glyphicon-search"></span><span class="sr-only"><?php echo esc_attr( __( 'Search', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></span></button>
</form>
