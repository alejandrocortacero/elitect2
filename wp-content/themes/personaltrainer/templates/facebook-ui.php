<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '<?php echo PersonalTrainerTheme::get_facebook_app_id(); ?>',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
