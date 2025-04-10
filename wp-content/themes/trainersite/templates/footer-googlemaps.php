<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
$maps = TrainerSiteThemeGoogleMaps::get_maps();
$markers = TrainerSiteThemeGoogleMaps::get_markers();
$api_key = TrainerSiteThemeGoogleMaps::get_api_key();
?>
<?php if( !empty( $maps ) && !empty( $api_key ) ) : ?>
<script type="text/javascript">
	var trainersiteGoogleMaps = {};
	var trainersiteGoogleMapsMarkers = {};
	function trainersiteLoadGoogleMaps(){
		<?php foreach( $maps as $map_name => $map ) : ?>
		trainersiteGoogleMaps['<?php echo esc_attr( $map_name ); ?>'] = new google.maps.Map(document.getElementById('<?php echo esc_attr( $map['id'] ); ?>'), <?php echo TrainerSiteThemeGoogleMaps::parse_vars( $map['attributes'] ); ?>);
		<?php endforeach; ?>
		<?php foreach( $markers as $marker_name => $marker ) : ?>
			trainersiteGoogleMapsMarkers['<?php echo esc_attr( $marker_name ); ?>'] = new google.maps.Marker(<?php echo TrainerSiteThemeGoogleMaps::parse_vars( $marker['attributes'] ); ?>);

		<?php endforeach; ?>
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&callback=trainersiteLoadGoogleMaps" async defer></script>
<?php endif; ?>
