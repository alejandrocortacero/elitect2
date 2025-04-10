<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="image-layer page-image-layer page-image-layer-<?php echo $image_key; ?>">
	<?php $is_image = EliteTrainerSiteThemeCustomizer::is_page_image_enabled( $image_key ) && !empty( EliteTrainerSiteThemeCustomizer::get_image_url( $image_key ) ); ?>
	<div class="image <?php if( !$is_image ) : ?>empty<?php endif; ?>">
		<?php if( $is_image  ) : ?>
			<img src="<?php echo EliteTrainerSiteThemeCustomizer::get_image_url( $image_key ); ?>" alt="Imagen" />
		<?php else : ?>
			<?php if( $default_image_url ) : ?>
				<img src="<?php echo esc_attr( $default_image_url ); ?>" alt="Imagen" />
			<?php else : ?>
				<?php if( EliteTrainerSiteThemeCustomizer::can_edit() ) : ?><p class="text-center"><code>Puede incluir una imagen aquí</code></p><?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( $image_key ); ?>
</div>


