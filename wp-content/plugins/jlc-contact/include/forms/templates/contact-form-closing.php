<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( !empty( $info_text ) ) : ?>
	<?php echo wp_kses_post( $info_text ); ?>
<?php endif; ?>
</form>
