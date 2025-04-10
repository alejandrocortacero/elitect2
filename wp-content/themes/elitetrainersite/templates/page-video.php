<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="video-layer page-video-layer page-video-layer-<?php echo $video_key; ?>" style="position:relative;">
	<?php $is_video = EliteTrainerSiteThemeCustomizer::is_page_video_enabled( $video_key ) && !empty( EliteTrainerSiteThemeCustomizer::get_video_link( $video_key ) ); ?>
	<div class="video <?php if( !$is_video ) : ?>empty<?php endif; ?>">
		<?php if( $is_video  ) : ?>
			<?php echo wp_kses( EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( EliteTrainerSiteThemeCustomizer::get_video_link( $video_key ) ), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
		<?php else : ?>
			<?php if( EliteTrainerSiteThemeCustomizer::can_edit() ) : ?><p class="text-center"><code>Puede incluir un video aquí</code></p><?php endif; ?>
		<?php endif; ?>
	</div>
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( $video_key ); ?>
</div>

