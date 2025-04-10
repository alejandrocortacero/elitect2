<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div id="fb-root"></div>
<?php if( false ) : ?>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.0&appId=<?php echo EliteTrainerSiteThemeFacebook::get_facebook_app_id(); ?>&autoLogAppEvents=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php else : ?>
 <script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.async = true;
 js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo EliteTrainerSiteThemeFacebook::get_facebook_app_id(); ?>";
 fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>
