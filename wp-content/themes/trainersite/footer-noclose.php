<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<?php get_template_part( 'templates/footer', 'menu' ); ?>
<?php get_template_part( 'templates/trainer', 'menu' ); ?>
<?php do_action( 'trainersitetheme_footer_after_static_content' ); ?>
<?php if( class_exists( 'JLCCookies' ) ) JLCCookies::print_cookies_message(); ?>
<?php //get_template_part( 'templates/social', 'fixed' ); ?>
<?php wp_footer(); ?>
</body>
</html>
