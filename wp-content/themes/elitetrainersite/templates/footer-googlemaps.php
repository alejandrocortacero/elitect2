<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
$maps = EliteTrainerSiteThemeGoogleMaps::get_maps();
$markers = EliteTrainerSiteThemeGoogleMaps::get_markers();
$api_key = EliteTrainerSiteThemeGoogleMaps::get_api_key();
?>
<?php if( !empty( $maps ) && !empty( $api_key ) ) : ?>
<script type="text/javascript">
	var elitetrainersiteGoogleMaps = {};
	var elitetrainersiteGoogleMapsMarkers = {};
	function elitetrainersiteLoadGoogleMaps(){
		<?php foreach( $maps as $map_name => $map ) : ?>
		elitetrainersiteGoogleMaps['<?php echo esc_attr( $map_name ); ?>'] = new google.maps.Map(document.getElementById('<?php echo esc_attr( $map['id'] ); ?>'), <?php echo EliteTrainerSiteThemeGoogleMaps::parse_vars( $map['attributes'] ); ?>);
		<?php endforeach; ?>
		<?php foreach( $markers as $marker_name => $marker ) : ?>
			elitetrainersiteGoogleMapsMarkers['<?php echo esc_attr( $marker_name ); ?>'] = new google.maps.Marker(<?php echo EliteTrainerSiteThemeGoogleMaps::parse_vars( $marker['attributes'] ); ?>);

		<?php endforeach; ?>
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&callback=elitetrainersiteLoadGoogleMaps" async defer></script>
<?php endif; ?>
