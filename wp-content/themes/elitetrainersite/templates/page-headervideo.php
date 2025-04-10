<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<div class="container page-header-video-container page-header-video-<?php echo $video_key; ?> first-container">
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'pagebg' ); ?>
	<div class="row title-row">
		<div class="col-xs-12">
			<h1 class="text-center"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( $title_key, $default_title ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( $title_key ); ?></h1>
			<div class="video-layer" style="position:relative;">
				<?php $is_video = EliteTrainerSiteThemeCustomizer::is_page_header_video_enabled( $video_key ) && !empty( EliteTrainerSiteThemeCustomizer::get_video_link( $video_key ) ); ?>
				<div class="video <?php if( !$is_video ) : ?>empty<?php endif; ?>">
					<?php if( $is_video  ) : ?>
						<?php echo wp_kses( EliteTrainerSiteThemeCustomizer::get_video_iframe_from_link( EliteTrainerSiteThemeCustomizer::get_video_link( $video_key ) ), array( 'iframe' => array( 'width' => array(), 'height' => array(), 'src' => array(), 'frameborder' => array(), 'allow' => array(), 'allowfullscreen' => array() ) ) ); ?>
					<?php else : ?>
						<?php if( EliteTrainerSiteThemeCustomizer::can_edit() ) : ?><p class="text-center"><code>Puede incluir un video aquí</code></p><?php endif; ?>
					<?php endif; ?>
				</div>
				<?php EliteTrainerSiteThemeCustomizer::print_edit_button( $video_key ); ?>
			</div>
			<h2 class="text-center" style="position:relative;"><span class="text"><?php echo EliteTrainerSiteThemeCustomizer::get_text_text( $subtitle_key, $default_subtitle ); ?></span><?php EliteTrainerSiteThemeCustomizer::print_edit_button( $subtitle_key ); ?></h2>
		</div>
	</div>
</div>
