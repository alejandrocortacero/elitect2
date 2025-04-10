<div class="container settings-menu">
	<div class="row">
		<div class="col-xs-12 settings-menu-col">
			<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SITE_STYLE_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Site Settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>"><?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'site_settings.svg' ) ); ?></a>
			<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::HOME_SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Home Settings', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>"><?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'house_settings.svg' ) ); ?></a>
			<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::TRAINER_EXERCISES_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Exercises Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>"><?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'exercises.svg' ) ); ?></a>
			<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Training Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>"><?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'help.svg' ) ); ?></a>
			<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Food Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>"><?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'help.svg' ) ); ?></a>
			<a href="<?php echo get_permalink( get_blog_option( null, TrainerSiteTheme::SETTINGS_PAGE_KEY ) ); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Diets Gallery', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>"><?php echo TrainerSiteTheme::get_svg_file_content( array( 'img', 'buttons', 'help.svg' ) ); ?></a>
		</div>
	</div>
</div>
