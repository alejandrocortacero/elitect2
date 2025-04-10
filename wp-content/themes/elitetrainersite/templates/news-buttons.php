<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<?php if( !is_single() ) : ?>
<a class="social-link"
	href="<?php echo esc_url( get_permalink() ); ?>"
	title="<?php echo $title = esc_attr( __( 'Read news', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	aria-label="<?php echo $title; ?>"
>
	<span class="fa fa-info-circle"></span>
</a>
<?php endif; ?>
<a class="social-link"
	rel="nofollow"
	href="<?php echo esc_url( get_permalink() ); ?>#comments"
	aria-label="<?php echo $title = esc_attr( __( 'Comments', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
>
	<span class="fa fa-comment"></span>
</a>
<a class="social-link"
	rel="nofollow"
	href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php echo rawurlencode( get_the_title() . ' - ' . get_permalink() ); ?>"
	aria-label="<?php echo $title = esc_attr( __( 'Share by mail', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
>
	<span class="fa fa-envelope"></span>
</a>
<a class="social-link"
	rel="nofollow"
	href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&amp;url=<?php the_permalink() ?>"
	aria-label="<?php echo $title = esc_attr( __( 'Share on Twitter', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
	target="_blank"
>
	<span class="fa fa-twitter"></span>
</a>
<?php if( $facebook_api_id = EliteTrainerSiteTheme::get_facebook_app_id() ) : ?>
<a class="social-link"
	rel="nofollow"
	href="https://www.facebook.com/dialog/share?app_id=<?php echo $facebook_api_id; ?>&display=popup&href=<?php echo urlencode( get_permalink() ) ; ?>&redirect_uri=<?php echo urlencode( get_permalink() ) ; ?>"
	aria-label="<?php echo $title = esc_attr( __( 'Share on Facebook', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
	target="_blank"
>
	<span class="fa fa-facebook"></span>
</a>
<?php endif; ?>
<?php if( false ) : ?>
<a class="social-link"
	rel="nofollow"
	href="#"
	aria-label="<?php echo $title = esc_attr( __( 'Share on Facebook', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
	target="_blank"
	onclick="event.preventDefault();FB.ui({ method: 'feed', link: '<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>', caption: 'Alfanje', picture:'http://jlc.org.es:96/wp-content/uploads/2018/02/serpiente.jpg' }, function(response){console.log(response)});"
>
	<span class="fa fa-facebook"></span>
</a>
<?php endif; ?>
<a
	class="social-link"
	rel="nofollow"
	aria-label="<?php echo $title = esc_attr( __( 'Share on Google +', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
	href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
	onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
	<span class="fa fa-google"></span>
</a>
<a class="social-link"
	rel="nofollow"
	aria-label="<?php echo $title = esc_attr( __( 'Share on Whatsapp', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
	href="whatsapp://send?text=<?php echo get_permalink(); ?>"
	data-action="share/whatsapp/share"
>
	<span class="fa fa-whatsapp"></span>
</a>
<a class="social-link"
	rel="nofollow"
	aria-label="<?php echo $title = esc_attr( __( 'Share on LinkedIn', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?>"
	title="<?php echo $title; ?>"
	href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&source=<?php echo esc_url( get_bloginfo( 'name' ) ); ?>"
	target="_blank"
>
	<span class="fa fa-linkedin"></span>
</a>
