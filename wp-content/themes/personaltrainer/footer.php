<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
</div>
<?php get_template_part( 'templates/footer', 'menu' ); ?>
<?php do_action( 'personaltrainertheme_footer_after_static_content' ); ?>
<?php if( class_exists( 'JLCCookies' ) ) JLCCookies::print_cookies_message(); ?>
<?php //get_template_part( 'templates/social', 'fixed' ); ?>
<?php wp_footer(); ?>
</body>
</html>
