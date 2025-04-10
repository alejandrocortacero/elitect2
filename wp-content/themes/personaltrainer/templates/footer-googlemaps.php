<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
$maps = PersonalTrainerThemeGoogleMaps::get_maps();
$markers = PersonalTrainerThemeGoogleMaps::get_markers();
$api_key = PersonalTrainerThemeGoogleMaps::get_api_key();
?>
<?php if( !empty( $maps ) && !empty( $api_key ) ) : ?>
<script type="text/javascript">
	var personaltrainerGoogleMaps = {};
	var personaltrainerGoogleMapsMarkers = {};
	function personaltrainerLoadGoogleMaps(){
		<?php foreach( $maps as $map_name => $map ) : ?>
		personaltrainerGoogleMaps['<?php echo esc_attr( $map_name ); ?>'] = new google.maps.Map(document.getElementById('<?php echo esc_attr( $map['id'] ); ?>'), <?php echo PersonalTrainerThemeGoogleMaps::parse_vars( $map['attributes'] ); ?>);
		<?php endforeach; ?>
		<?php foreach( $markers as $marker_name => $marker ) : ?>
			personaltrainerGoogleMapsMarkers['<?php echo esc_attr( $marker_name ); ?>'] = new google.maps.Marker(<?php echo PersonalTrainerThemeGoogleMaps::parse_vars( $marker['attributes'] ); ?>);

		<?php endforeach; ?>
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>&callback=personaltrainerLoadGoogleMaps" async defer></script>
<?php endif; ?>
